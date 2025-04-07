<?php
require_once 'Databases/Database.php';

class OrderModel {
    public $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function beginTransaction() {
        $this->db->query("START TRANSACTION");
    }

    public function commit() {
        $this->db->query("COMMIT");
    }

    public function rollBack() {
        $this->db->query("ROLLBACK");
    }

    public function insertOrder($orderData) {
        $sql = "INSERT INTO orders (user_id, order_date, total_amount) 
                VALUES (:user_id, :order_date, :total_amount)";
        $this->db->query($sql, [
            ':user_id' => $orderData['user_id'],
            ':order_date' => $orderData['order_date'],
            ':total_amount' => $orderData['total_amount']
        ]);
        return $this->db->getLastInsertId();
    }

    public function insertOrderDetails($orderID, $productID, $quantity, $subtotal) {
        $sqlCheckProduct = "SELECT id FROM products WHERE id = :product_id";
        $stmt = $this->db->query($sqlCheckProduct, [':product_id' => $productID]);
        if (!$stmt->fetch()) {
            throw new Exception("Product ID $productID does not exist");
        }

        $sql = "INSERT INTO order_details (order_id, product_id, quantity, subtotal) 
                VALUES (:order_id, :product_id, :quantity, :subtotal)";
        $result = $this->db->query($sql, [
            ':order_id' => $orderID,
            ':product_id' => $productID,
            ':quantity' => $quantity,
            ':subtotal' => $subtotal
        ]);
        return $result->rowCount() > 0;
    }

    public function updateProductStock($productId, $quantity) {
        $sqlCheck = "SELECT stock_quantity FROM products WHERE id = :product_id";
        $stmt = $this->db->query($sqlCheck, [':product_id' => $productId]);
        $currentStock = $stmt->fetchColumn();

        if ($currentStock === false) {
            throw new Exception("Product ID $productId does not exist.");
        }
        if ($currentStock < $quantity) {
            throw new Exception("Insufficient stock for product ID $productId. Available: $currentStock, Requested: $quantity.");
        }

        $sql = "UPDATE products 
                SET stock_quantity = stock_quantity - :quantity, 
                    stock = IF(stock_quantity - :quantity <= 0, 'Out of stock', 'In stock') 
                WHERE id = :product_id";
        $result = $this->db->query($sql, [
            ':product_id' => $productId,
            ':quantity' => $quantity
        ]);
        return $result->rowCount() > 0;
    }

    public function getAllOrders() {
        $sql = "SELECT o.order_id, CONCAT(u.FirstName, ' ', u.LastName) AS user_name, 
                       o.order_date, o.total_amount 
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                ORDER BY o.order_date DESC";
        return $this->db->query($sql)->fetchAll() ?: [];
    }
}