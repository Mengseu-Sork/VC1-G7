<?php
require_once 'Databases/Database.php';

class ViewProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // Get all products
    public function getAllProducts() {
        $query = "SELECT * FROM product";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    // Add a product
    public function createProduct($data) {
        $stmt = "INSERT INTO product (product_name, price, type, date, image, description)
                 VALUES (:product_name, :price, :type, :date, :image, :description)";
        return $this->db->query($stmt, [
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'type' => $data['type'],
            'date' => $data['date'],
            'image' => $data['image'],
            'description' => $data['description'],
        ]);
    }

    public function getProductById($id) {
        $query = "SELECT * FROM product WHERE id = :id";
        $result = $this->db->query($query, ['id' => $id]);
        return $result->fetch();
    }

    public function updateProduct($id, $data) {
        $stmt = "UPDATE product SET product_name = :product_name, price = :price, type = :type, date = :date, image = :image WHERE id = :id";
        return $this->db->query($stmt, [
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'type' => $data['type'],
            'date' => $data['date'],
            'image' => $data['image'],
            'id' => $id,
        ]);
    }

    public function deleteProduct($id) {
        return $this->db->query('DELETE FROM product WHERE id = :id', ['id'=> $id]);
    }
}
?>