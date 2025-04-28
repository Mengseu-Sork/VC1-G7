<?php
require_once 'Databases/Database.php';

class OrderModel
{
    private $db;
    //private $hasUserIdColumn = true; // We'll check this dynamically - REMOVED
    private $hasUserIdColumn = true; // We'll check this dynamically

    public function __construct()
    {
        $this->db = new Database();
        // Check if the orders table has a user_id column
        //$this->checkTableStructure(); - REMOVED
    }

    /*private function checkTableStructure() - REMOVED
    {
        try {
            $pdo = $this->db->getConnection();
            
            // Get the table structure
            $stmt = $pdo->prepare("DESCRIBE orders");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
            // Check if user_id exists in the columns
            $this->hasUserIdColumn = in_array('user_id', $columns);
            
            error_log("Orders table " . ($this->hasUserIdColumn ? "has" : "does not have") . " user_id column");
        } catch (PDOException $e) {
            error_log("Error checking table structure: " . $e->getMessage());
            // Default to assuming the column exists to maintain backward compatibility
            $this->hasUserIdColumn = true;
        }
    }*/

    public function getUserByEmail($email)
    {
        try {
            $pdo = $this->db->getConnection();
            $stmt = $pdo->prepare("SELECT id, FirstName, LastName FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                error_log("Found user with ID: " . $user['id'] . " for email: " . $email);
            } else {
                error_log("No user found for email: " . $email);
            }
            
            return $user;
        } catch (PDOException $e) {
            error_log("Error in getUserByEmail: " . $e->getMessage());
            return false;
        }
    }
    
    public function createUser($firstName, $lastName, $email, $phone)
    {
        try {
            // First check if user already exists
            $existingUser = $this->getUserByEmail($email);
            if ($existingUser) {
                error_log("User already exists with ID: " . $existingUser['id']);
                return $existingUser['id'];
            }
            
            $pdo = $this->db->getConnection();
            
            // Log the SQL and parameters for debugging
            $sql = "INSERT INTO users (FirstName, LastName, email, phone) VALUES (?, ?, ?, ?)";
            error_log("Creating user with SQL: " . $sql);
            error_log("Parameters: " . $firstName . ", " . $lastName . ", " . $email . ", " . $phone);
            
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$firstName, $lastName, $email, $phone]);
            
            if (!$result) {
                error_log("Failed to execute user creation SQL: " . print_r($stmt->errorInfo(), true));
                throw new Exception("Failed to create user: " . implode(", ", $stmt->errorInfo()));
            }
            
            $userId = $pdo->lastInsertId();
            error_log("Created new user with ID: " . $userId);
            
            // Verify the user was created
            $verifyUser = $this->getUserByEmail($email);
            if (!$verifyUser) {
                error_log("Failed to verify newly created user with ID: " . $userId);
                throw new Exception("User was created but could not be verified");
            }
            
            return $userId;
        } catch (PDOException $e) {
            error_log("Create user error: " . $e->getMessage() . " - Code: " . $e->getCode());
            
            // If it's a duplicate key error, try to get the existing user
            if ($e->getCode() == 23000) {
                $existingUser = $this->getUserByEmail($email);
                if ($existingUser) {
                    error_log("Recovered user ID after duplicate key error: " . $existingUser['id']);
                    return $existingUser['id'];
                }
            }
            
            throw new Exception("Database error creating user: " . $e->getMessage());
        }
    }

    public function createOrder($userId, $totalAmount, $products, $firstName, $lastName, $phone, $email)
    {
        $pdo = $this->db->getConnection();
        $transactionStarted = false;

        try {
            if (empty($products)) {
                throw new Exception("No products provided for the order.");
            }
            
            // Check the structure of the orders table
            $stmt = $pdo->query("DESCRIBE orders");
            $columns = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $columns[$row['Field']] = $row;
            }
            
            // Start transaction
            $pdo->beginTransaction();
            $transactionStarted = true;
            
            // Prepare the SQL statement based on table structure
            $sql = "INSERT INTO orders (";
            $placeholders = "";
            $params = [];
            
            // Always include these fields
            $fields = [
                'total_amount' => $totalAmount,
                'FirstName' => $firstName,
                'LastName' => $lastName,
                'phone' => $phone,
                'email' => $email
            ];
            
            // Add user_id if the column exists
            if (isset($columns['user_id'])) {
                $fields['user_id'] = $userId;
            }
            
            // Build the SQL dynamically based on available columns
            $first = true;
            foreach ($fields as $field => $value) {
                if (!$first) {
                    $sql .= ", ";
                    $placeholders .= ", ";
                }
                $sql .= $field;
                $placeholders .= "?";
                $params[] = $value;
                $first = false;
            }
            
            // Add order_date if not auto-filled
            if (!isset($columns['order_date']) || $columns['order_date']['Default'] === null) {
                $sql .= ", order_date";
                $placeholders .= ", NOW()";
            }
            
            $sql .= ") VALUES (" . $placeholders . ")";
            
            error_log("Executing order insert with SQL: " . $sql);
            error_log("Parameters: " . implode(", ", $params));
            
            $orderStmt = $pdo->prepare($sql);
            $orderResult = $orderStmt->execute($params);
            
            if (!$orderResult) {
                error_log("Order insert failed: " . print_r($orderStmt->errorInfo(), true));
                throw new Exception("Failed to insert order: " . $orderStmt->errorInfo()[2]);
            }

            $orderId = $pdo->lastInsertId();
            if (!$orderId) {
                throw new Exception("Failed to get last insert ID for order.");
            }
            
            error_log("Created order with ID: " . $orderId);

            // Insert into order_detail table
            $itemStmt = $pdo->prepare("
                INSERT INTO order_detail (order_id, product_id, quantity, subtotal) 
                VALUES (?, ?, ?, ?)
            ");

            foreach ($products as $product) {
                // Check if product_id is numeric
                if (!isset($product['product_id']) || !is_numeric($product['product_id'])) {
                    error_log("Invalid product_id: " . print_r($product, true));
                    throw new Exception("Invalid product ID in order.");
                }
                
                if (!isset($product['quantity'], $product['subtotal'])) {
                    error_log("Incomplete product data: " . print_r($product, true));
                    throw new Exception("Incomplete product data for product.");
                }
                
                error_log("Adding product ID: " . $product['product_id'] . " to order");

                // Check stock if needed
                if (isset($product['check_stock']) && $product['check_stock']) {
                    $stockStmt = $pdo->prepare("SELECT quantity FROM stock WHERE product_id = ?");
                    $stockStmt->execute([$product['product_id']]);
                    $stock = $stockStmt->fetch(PDO::FETCH_ASSOC);

                    if (!$stock) {
                        error_log("No stock found for product ID: " . $product['product_id']);
                        // Continue without stock check if no stock record exists
                    } else if ($stock['quantity'] < $product['quantity']) {
                        throw new Exception("Insufficient stock for product ID {$product['product_id']}. Available: " . ($stock['quantity'] ?? 0));
                    } else {
                        // Update stock
                        $updateStockStmt = $pdo->prepare("
                            UPDATE stock SET quantity = quantity - ? WHERE product_id = ?
                        ");
                        $updateStockStmt->execute([$product['quantity'], $product['product_id']]);
                    }
                }

                $detailResult = $itemStmt->execute([$orderId, $product['product_id'], $product['quantity'], $product['subtotal']]);
                
                if (!$detailResult) {
                    error_log("Order detail insert failed: " . print_r($itemStmt->errorInfo(), true));
                    throw new Exception("Failed to insert order detail: " . $itemStmt->errorInfo()[2]);
                }
            }

            // Commit the transaction
            $pdo->commit();
            error_log("Order transaction committed successfully");
            
            return $orderId;

        } catch (Exception $e) {
            error_log("Order creation failed: " . $e->getMessage());
            
            // Only rollback if transaction was started
            if ($transactionStarted) {
                try {
                    $pdo->rollBack();
                    error_log("Transaction rolled back due to error");
                } catch (PDOException $rollbackException) {
                    error_log("Rollback failed: " . $rollbackException->getMessage());
                }
            }
            
            throw $e; // Re-throw to allow controller to handle it
        }
    }

    public function getOrdersByUser($userId)
    {
        try {
            $pdo = $this->db->getConnection();
            
            // Check if user_id column exists in orders table
            $stmt = $pdo->query("DESCRIBE orders");
            $hasUserIdColumn = false;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($row['Field'] === 'user_id') {
                    $hasUserIdColumn = true;
                    break;
                }
            }
            
            if ($hasUserIdColumn) {
                // If user_id exists, use it to filter orders
                $query = "
                    SELECT o.order_id, o.order_date, o.total_amount, o.FirstName, o.LastName
                    FROM orders o
                    WHERE o.user_id = :user_id
                    ORDER BY o.order_date DESC
                ";
                $params = ['user_id' => $userId];
            } else {
                // Otherwise, try to match by email
                $user = $this->getUserById($userId);
                if (!$user || !isset($user['email'])) {
                    return [];
                }
                
                $query = "
                    SELECT o.order_id, o.order_date, o.total_amount, o.FirstName, o.LastName
                    FROM orders o
                    WHERE o.email = :email
                    ORDER BY o.order_date DESC
                ";
                $params = ['email' => $user['email']];
            }
            
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return [];
        }
    }
    
    private function getUserById($userId)
    {
        try {
            $pdo = $this->db->getConnection();
            $stmt = $pdo->prepare("SELECT id, FirstName, LastName, email FROM users WHERE id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getUserById: " . $e->getMessage());
            return false;
        }
    }
}