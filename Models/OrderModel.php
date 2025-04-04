<?php
require_once("Databases/Database.php");

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function insertOrder($orderData) {
        $sql = "INSERT INTO orders (user_id, order_date, total_amount) VALUES (:user_id, :order_date, :total_amount)";
        $stmt = $this->db->query($sql, [
            ':user_id' => $orderData['user_id'],
            ':order_date' => $orderData['order_date'],
            ':total_amount' => $orderData['total_amount']
        ]);

        return $stmt ? $this->db->query("SELECT LAST_INSERT_ID()")->fetchColumn() : false;
    }

    public function getAllOrders() {
        $sql = "SELECT o.order_id, CONCAT(u.FirstName, ' ', u.LastName) AS user_name, o.order_date, o.total_amount 
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                ORDER BY o.order_date DESC";
        return $this->db->query($sql)->fetchAll() ?: []; 
    }

    public function getOrderDetails($order_id) {
        $checkTable = $this->db->query("SHOW TABLES LIKE 'order_details'")->fetchColumn();
        if (!$checkTable) {
            return [];
        }

        $sql = "SELECT od.order_detail_id, od.order_id, od.quantity, od.subtotal, p.name AS product_name
                FROM order_details od
                JOIN products p ON od.product_id = p.id
                WHERE od.order_id = :order_id";
        return $this->db->query($sql, [':order_id' => $order_id])->fetchAll() ?: [];
    }

    public function insertOrderDetails($orderID, $productID, $quantity, $subtotal) {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, subtotal) VALUES (:order_id, :product_id, :quantity, :subtotal)";
        return $this->db->query($sql, [
            ':order_id' => $orderID,
            ':product_id' => $productID,
            ':quantity' => $quantity,
            ':subtotal' => $subtotal
        ]);
    }
}
?>
