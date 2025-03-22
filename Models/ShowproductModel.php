<?php
require_once 'Databases/Database.php';

// ProductModel.php
class ShowproductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // Get all products
    function getShowProducts() {
        $query = "SELECT * FROM products";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}