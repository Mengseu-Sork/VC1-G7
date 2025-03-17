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
<<<<<<< HEAD
    function addProduct($name, $price) {
        $query = "INSERT INTO product (name, price) VALUES (?, ?)";
        $stmt = $this->db->query($query);
        return $stmt->execute([$name, $price]);
=======
    function createProduct($data) {
        $stmt = "INSERT INTO product (product_name, price, type, date, image)
                 VALUES (:product_name, :price, :type, :date, :image)";
        $this->db->query($stmt, [
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'type' => $data['type'],
            'date' => $data['date'],
            'image' => $data['image'],
        ]);
    }
    function getProductById($id){
        $query = "SELECT * FROM product WHERE id = :id";
        $result = $this->db->query($query, ['id' => $id]);
        return $result->fetch();
    }
    function updateProduct($data){
        $stmt = "UPDATE product SET product_name = :product_name, price = :price, type = :type, date = :date, image = :image WHERE id = :id";
        $this->db->query($stmt, [
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'type' => $data['type'],
            'date' => $data['date'],
            'image' => $data['image'],
            'id' => $data['id']
        ]);
>>>>>>> e37aa4e4f99a93e0efb02bbbda6050b8ff1b8e42
    }
}
?>