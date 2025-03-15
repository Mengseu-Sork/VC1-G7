<?php
require_once "Database.php"; // Adjust the path as necessary

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllProducts() {
        return $this->db->query("SELECT * FROM product")->fetchAll();
    }

  
}
?>
