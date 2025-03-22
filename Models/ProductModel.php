<?php
require_once 'Databases/Database.php';

// ProductModel.php
class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $result = $this->db->query($query);
        return $result->fetchAll();
        
    }

    function getAllProducts() {
        try {
            $result = $this->db->query("SELECT 
                products.id, 
                products.name,
                products.price, 
                products.date, 
                products.image,
                products.category_id,   
                categories.name AS category_name
                FROM products 
                LEFT JOIN categories ON products.category_id = categories.category_id");
            return $result->fetchAll();
        } catch (Exception $e) {
            die("Error fetching products: " . $e->getMessage());
        }
    }

    function getProductTypes() {
        try {
            $result = $this->db->query("SELECT category_id, name FROM categories");
            return $result->fetchAll();
        } catch (Exception $e) {
            die("Error fetching product types: " . $e->getMessage());
        }
    }

    function createProduct($data) {
        $stmt = "INSERT INTO products (name, price, category_id, date, image)
                 VALUES (:name, :price, :category_id, :date, :image)";
        return $this->db->query($stmt, [
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'date' => $data['date'],
            'image' => $data['image'],
        ]);
    }

    function getProductById($id){
        $query = "SELECT * FROM products WHERE id = :id";
        $result = $this->db->query($query, ['id' => $id]);
        return $result->fetch();
    }

    function updateProduct($data){
        $stmt = "UPDATE product SET product_name = :product_name, price = :price, type = :type, date = :date, image = :image WHERE id = :id";
        $this->db->query($stmt, [
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
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
