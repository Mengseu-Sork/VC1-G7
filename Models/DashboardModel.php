<?php
require_once 'Databases/Database.php';

class DashboardModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function getProductCount() {
        $sql = "SELECT COUNT(*) as total FROM products";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total'];
    }


    public function getTotalStockQuantity() {
        $sql = "SELECT SUM(quantity) AS total_quantity FROM stock";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();
        return $result['total_quantity'];
    }
}