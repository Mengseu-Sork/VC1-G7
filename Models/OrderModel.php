<?php
require_once("Databases/Database.php");

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insertOrder($orderData) {
        $sql = "INSERT INTO orders (user_id, product_id, quantity, total_price, order_status, order_date) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->query($sql, [
            $orderData['user_id'],
            $orderData['product_id'],
            $orderData['quantity'],
            $orderData['total_price'],
            $orderData['order_status'],
            $orderData['order_date']
        ]);

        return $stmt ? $this->db->query("SELECT LAST_INSERT_ID()")->fetchColumn() : false;
    }

    public function getAllOrders() {
        $sql = "SELECT o.id, u.name AS user_name, p.name AS product_name, o.quantity, o.total_price, o.order_status, o.order_date 
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                JOIN products p ON o.product_id = p.id 
                ORDER BY o.order_date DESC";
        return $this->db->query($sql)->fetchAll();
    }
}
?>
