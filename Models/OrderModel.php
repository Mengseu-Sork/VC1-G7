<?php

require_once 'Databases/Database.php';

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getOrders() {
        $query = "SELECT orders.order_id, orders.user_id, orders.order_date, orders.total_amount,
                         users.FirstName, users.LastName
                  FROM orders
                  JOIN users ON orders.user_id = users.user_id";
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($order_id) {
        $query = "SELECT orders.order_id, orders.user_id, orders.order_date, orders.total_amount,
                         users.FirstName, users.LastName
                  FROM orders
                  JOIN users ON orders.user_id = users.user_id
                  WHERE orders.order_id = ?";
        $result = $this->db->query($query, [$order_id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function createOrder($data) {
        $stmt = "INSERT INTO orders (user_id, order_date, total_amount)
                 VALUES (:user_id, :order_date, :total_amount)";
        return $this->db->query($stmt, [
            'user_id' => $data['user_id'],
            'order_date' => $data['order_date'],
            'total_amount' => $data['total_amount']
        ]);
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
