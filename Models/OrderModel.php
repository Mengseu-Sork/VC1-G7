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
}
