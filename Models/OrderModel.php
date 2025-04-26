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

    public function userExists($userId)
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->prepare("SELECT id FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch() !== false;
    }

    public function createOrder($userId, $totalAmount, $products)
    {
        $pdo = $this->db->getConnection();

        try {
            if (empty($products)) {
                throw new Exception("No products provided for the order.");
            }

            $pdo->beginTransaction();

            $orderStmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, order_date) VALUES (?, ?, NOW())");
            $orderStmt->execute([$userId, $totalAmount]);
            $orderId = $pdo->lastInsertId();

            $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, subtotal) VALUES (?, ?, ?, ?)");

            foreach ($products as $product) {
                if (!isset($product['product_id'], $product['quantity'], $product['subtotal'])) {
                    throw new Exception("Incomplete product data.");
                }

                $stockStmt = $pdo->prepare("SELECT quantity FROM stock WHERE product_id = ?");
                $stockStmt->execute([$product['product_id']]);
                $stock = $stockStmt->fetch(PDO::FETCH_ASSOC);

                if (!$stock || $stock['quantity'] < $product['quantity']) {
                    throw new Exception("Insufficient stock for product ID {$product['product_id']}");
                }

                $itemStmt->execute([$orderId, $product['product_id'], $product['quantity'], $product['subtotal']]);

                $updateStockStmt = $pdo->prepare("UPDATE stock SET quantity = quantity - ? WHERE product_id = ?");
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
            $query = "SELECT o.order_id, o.order_date, o.total_amount
                      FROM orders o
                      WHERE o.user_id = :user_id
                      ORDER BY o.order_date DESC";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['user_id' => $userId]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return [];
        }
    }
}
