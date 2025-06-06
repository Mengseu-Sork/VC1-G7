<?php
require_once 'Databases/Database.php';

class ShowproductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    function getShowProducts() {
        $query = "SELECT * FROM products";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    public function getAllStock() {
        $query = "SELECT * FROM stock";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    function getProductTypes() {
        try {
            $result = $this->db->query("SELECT category_id, name FROM categories");
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching product types: " . $e->getMessage());
            return [];
        }
    }

    function getProductById($id) {
        try {
            $query = "SELECT * FROM products WHERE id = :id";
            $result = $this->db->query($query, ['id' => $id]);
            return $result->fetch();
        } catch (Exception $e) {
            error_log("Error getting product by ID: " . $e->getMessage());
            return false;
        }
    }

    function getCategoryById($category_id) {
        try {
            $query = "SELECT * FROM categories WHERE category_id = :category_id";
            $result = $this->db->query($query, ['category_id' => $category_id]);
            return $result->fetch();
        } catch (Exception $e) {
            error_log("Error getting category by ID: " . $e->getMessage());
            return false;
        }
    }

    function incrementViewCount($id) {
        try {
            $query = "UPDATE products SET view_count = view_count + 1 WHERE id = :id";
            $this->db->query($query, ['id' => $id]);
        } catch (Exception $e) {
            error_log("Error incrementing view count: " . $e->getMessage());
        }
    }
    function getAllCategories() {
        try {
            $query = "SELECT * FROM categories";
            $result = $this->db->query($query);
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching categories: " . $e->getMessage());
            return [];
        }
    }
    

}