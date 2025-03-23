<?php
require_once 'Databases/Database.php';
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

    public function createProduct($data) {
        $query = "INSERT INTO products (name, price, category_id, date, image) 
                 VALUES (:name, :price, :category_id, :date, :image)";
                 
        return $this->db->query($query, [
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'date' => $data['date'],
            'image' => $data['image']
        ]);
    }
    public function updateProduct($id, $data) {
        $query = "UPDATE products SET name = :name, price = :price, category_id = :category_id, date = :date, image = :image WHERE id = :id";
        
        return $this->db->query($query, [
            'id' => $id,
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'date' => $data['date'],
            'image' => $data['image']
        ]);
    }
    public function deleteProduct($id) {
        $query = "DELETE FROM products WHERE id = :id";
        return $this->db->query($query, ['id' => $id]);
    }
    public function getAllProductsByCategory($categoryId) {
        $query = "SELECT * FROM products WHERE category_id = :category_id";
        $result = $this->db->query($query, ['category_id' => $categoryId]);
        return $result->fetchAll();
    }
    public function getAllProductsBySearch($search) {
        $query = "SELECT * FROM products WHERE name LIKE :search";
        $result = $this->db->query($query, ['search' => '%' . $search . '%']);
        return $result->fetchAll();
    }
    public function getAllProductsByDate($date) {
        $query = "SELECT * FROM products WHERE date = :date";
        $result = $this->db->query($query, ['date' => $date]);
        return $result->fetchAll();
    }
    public function getAllProductsByPrice($price) {
        $query = "SELECT * FROM products WHERE price = :price";
        $result = $this->db->query($query, ['price' => $price]);
        return $result->fetchAll();
    }
    public function getAllProductsByImage($image) {
        $query = "SELECT * FROM products WHERE image = :image";
        $result = $this->db->query($query, ['image' => $image]);
        return $result->fetchAll();
    }
    public function getAllProductsByCategoryAndPrice($categoryId, $price) {
        $query = "SELECT * FROM products WHERE category_id = :category_id AND price = :price";
        $result = $this->db->query($query, ['category_id' => $categoryId, 'price' => $price]);
        return $result->fetchAll();
    }
    public function getAllProductsByCategoryAndDate($categoryId, $date) {
        $query = "SELECT * FROM products WHERE category_id = :category_id AND date = :date";
        $result = $this->db->query($query, ['category_id' => $categoryId, 'date' => $date]);
        return $result->fetchAll();
    }
    public function getAllProductsByCategoryAndImage($categoryId, $image) {
        $query = "SELECT * FROM products WHERE category_id = :category_id AND image = :image";
        $result = $this->db->query($query, ['category_id' => $categoryId, 'image' => $image]);
        return $result->fetchAll();
    }
    public function getAllProductsByDateAndPrice($date, $price) {
        $query = "SELECT * FROM products WHERE date = :date AND price = :price";
        $result = $this->db->query($query, ['date' => $date, 'price' => $price]);
        return $result->fetchAll();
    }

    public function getProductById($id) {
        $query = "SELECT * FROM products WHERE id = :id";
        $result = $this->db->query($query, ['id' => $id]);
        return $result->fetch();
    }
}
?>