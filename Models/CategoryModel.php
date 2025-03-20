<?php
require_once 'Databases/Database.php';

class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // Get all categories
    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $result = $this->db->query($query);
        return $result->fetchAll();
        
    }
    public function createProduct($data)
{
    $sql = "INSERT INTO products (name, price, type, date, image) VALUES (:name, :price, :type, :date, :image)";
    $stmt = $this->db->query($sql);

    return $stmt->execute([
        ':name' => $data['name'],
        ':price' => $data['price'],
        ':type' => $data['type'],
        ':date' => $data['date'],
        ':image' => $data['image'],
    ]);
}

    // Get category by ID
    // public function getCategoryById($id) {
    //     $query = "SELECT * FROM categories WHERE category_id = :id";
    //     $stmt = $this->db->query($query, ['id' => $id]); 
    //     return $stmt->fetch();
    // }
}
?>
