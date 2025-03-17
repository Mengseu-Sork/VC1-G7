<?php
require_once 'Databases/database.php';

// ProductModel.php
class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // Get all products
    function getAllProducts() {
        $query = "SELECT * FROM product";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    // Add a product (example function)
    function addProduct($name, $price) {
        $query = "INSERT INTO product (name, price) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$name, $price]);
    }

    
}
?>