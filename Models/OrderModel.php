<?php
require_once 'Databases/Database.php';

class OrderModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllOrders() {
        $sql = "SELECT 
                    CONCAT(u.FirstName, ' ', u.LastName) AS user_name,
                    od.subtotal AS price,
                    o.order_date AS date
                FROM orders o
                LEFT JOIN users u ON o.users_id = u.id
                LEFT JOIN order_detail od ON o.order_id = od.order_id";
        $stmt = $this->db->query($sql);
        return $this->db->fetchAll($stmt);
    }

    public function getOrderById($id) {
        $sql = "SELECT 
                    CONCAT(u.FirstName, ' ', u.LastName) AS user_name,
                    o.order_date,
                    SUM(od.subtotal) AS total_price
                FROM orders o
                LEFT JOIN users u ON o.users_id = u.id
                LEFT JOIN order_detail od ON o.order_id = od.order_id";
    
        $stmt = $this->db->query($sql, ['id' => $id]);
        return $this->db->fetch($stmt);
    }
    

    public function __destruct() {
        $this->db->closeConnection();
    }
}
?>
