<?php
// OrderModel.php
require_once 'Databases/Database.php';

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createOrder($userId, $totalAmount, $products, $pickupDate = null, $pickupTime = null)
    {
        try {
            if (empty($products)) {
                throw new Exception("No products provided for the order.");
            }
    
            $pdo = $this->db->getConnection();
            $pdo->beginTransaction();
    
            $orderStmt = $this->db->query("INSERT INTO orders (user_id, total_amount, pickup_date, pickup_time, order_date) VALUES (?, ?, ?, ?, NOW())");
            $orderStmt->execute([$userId, $totalAmount, $pickupDate, $pickupTime]);
            $orderId = $pdo->lastInsertId();
    
            $itemStmt = $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)");
    
            foreach ($products as $product) {
                if (!isset($product['product_id'], $product['quantity'], $product['subtotal'])) {
                    throw new Exception("Product data is incomplete for product ID: " . ($product['product_id'] ?? 'unknown'));
                }
    
                $stockStmt = $this->db->query("SELECT quantity FROM stock WHERE product_id = ?");
                $stockStmt->execute([$product['product_id']]);
                $stockResult = $stockStmt->fetch(PDO::FETCH_ASSOC);
    
                if (!$stockResult) {
                    throw new Exception("Product ID " . $product['product_id'] . " not found in stock.");
                }
                if ($stockResult['quantity'] < $product['quantity']) {
                    throw new Exception("Insufficient stock for product ID: " . $product['product_id'] . ". Available: " . $stockResult['quantity']);
                }
    
                $itemStmt->execute([$orderId, $product['product_id'], $product['quantity'], $product['subtotal']]);
    
                $updateStockStmt = $this->db->query("UPDATE stock SET quantity = quantity - ? WHERE product_id = ?");
                $updateStockStmt->execute([$product['quantity'], $product['product_id']]);
            }
    
            $pdo->commit();
            return $orderId;
        } catch (Exception $e) {
            $pdo->rollBack();
            error_log('Order creation failed: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
            exit;
        }
    }

    public function getOrdersByUser($userId)
    {
        try {
            $query = "SELECT o.order_id, CONCAT(u.firstName, ' ', u.lastName) AS user_name, o.order_date, o.total_amount
                      FROM orders o
                      JOIN users u ON o.user_id = u.id
                      WHERE o.user_id = :user_id
                      ORDER BY o.order_date DESC";
            $result = $this->db->query($query, ['user_id' => $userId]);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return [];
        }
    }
}