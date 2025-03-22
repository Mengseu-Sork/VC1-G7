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
        $query = "SELECT * FROM products";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    // Add a product (example function)
    function createProduct($data) {
        $stmt = "INSERT INTO products (name, price, type, date, image)
                 VALUES (:name, :price, :type, :date, :image)";
        $this->db->query($stmt, [
            'name' => $data['name'],
            'price' => $data['price'],
            'type' => $data['type'],
            'date' => $data['date'],
            'image' => $data['image'],
        ]);
    }
    function getProductById($id){
        $query = "SELECT * FROM products WHERE id = :id";
        $result = $this->db->query($query, ['id' => $id]);
        return $result->fetch();
    }
    function updateProduct($id, $data) {
        $stmt = "UPDATE products SET name = :name, price = :price, type = :type, date = :date WHERE id = :id";
        $this->db->query($stmt, [
            'name' => $data['name'],
            'price' => $data['price'],
            'type' => $data['type'],
            'date' => $data['date'],
            'id' => $id,
        ]);
    }
    function deleteProduct($id){
        $stmt =$this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->query($stmt, ['id' => $id]);
    }
}
?>
