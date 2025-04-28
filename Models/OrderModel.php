<?php
require_once 'Databases/Database.php';

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserByEmail($email)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->query("SELECT id, first_name, last_name FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($firstName, $lastName, $email, $phone)
    {
        try {
            $pdo = $this->db->getConnection();
            $stmt = $pdo->query("
            INSERT INTO users (first_name, last_name, email, phone) 
            VALUES (?, ?, ?, ?)
        ");
            $stmt->execute([$firstName, $lastName, $email, $phone]);
            return $pdo->lastInsertId();  
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {  
                error_log("Duplicate email error: " . $e->getMessage());
                return false;
            }
            error_log("Create user error: " . $e->getMessage());
            return false;
        }
    }


    public function createOrder($userId, $totalAmount, $products)
    {
        $pdo = $this->db->getConnection();

        try {
            if (empty($products)) {
                throw new Exception("No products provided for the order.");
            }

            $pdo->beginTransaction();

            $orderStmt = $pdo->query("
                INSERT INTO orders (user_id, total_amount, order_date) 
                VALUES (?, ?, NOW())
            ");
            $orderStmt->execute([$userId, $totalAmount]);

            $orderId = $pdo->lastInsertId();
            if (!$orderId) {
                throw new Exception("Failed to insert order into orders table.");
            }


            $itemStmt = $pdo->query("
                INSERT INTO order_items (order_id, product_id, quantity, subtotal) 
                VALUES (?, ?, ?, ?)
            ");

            foreach ($products as $product) {
                if (!isset($product['product_id'], $product['quantity'], $product['subtotal'])) {
                    throw new Exception("Incomplete product data for product ID {$product['product_id']}.");
                }

                $stockStmt = $pdo->query("SELECT quantity FROM stock WHERE product_id = ?");
                $stockStmt->execute([$product['product_id']]);
                $stock = $stockStmt->fetch(PDO::FETCH_ASSOC);

                if (!$stock || $stock['quantity'] < $product['quantity']) {
                    throw new Exception("Insufficient stock for product ID {$product['product_id']}. Available: " . ($stock['quantity'] ?? 0));
                }

                $itemStmt->execute([$orderId, $product['product_id'], $product['quantity'], $product['subtotal']]);
                $updateStockStmt = $pdo->query("
                    UPDATE stock SET quantity = quantity - ? WHERE product_id = ?
                ");
                $updateStockStmt->execute([$product['quantity'], $product['product_id']]);
            }

            $pdo->commit();
            return $orderId;

        } catch (Exception $e) {
            $pdo->rollBack();
            error_log("Order creation failed: " . $e->getMessage());
            return false;
        }
    }

    public function getOrdersByUser($userId)
    {
        try {
            $pdo = $this->db->getConnection();
            $query = "
                SELECT o.order_id, o.order_date, o.total_amount, u.first_name, u.last_name
                FROM orders o
                JOIN users u ON o.user_id = u.id
                WHERE o.user_id = :user_id
                ORDER BY o.order_date DESC
            ";
            $stmt = $pdo->query($query);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return [];
        }
    }
}
