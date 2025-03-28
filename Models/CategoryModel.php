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
    public function getCategoryById($id) {
        $query = "SELECT * FROM categories WHERE category_id = :id";
        $stmt = $this->db->query($query, ['id' => $id]); 
        return $stmt->fetch();
    }

    function createCategories($data)
    {
        $this->db->query("INSERT INTO categories (name, description) VALUES (:name, :description)",
        [
            'name' => $data['name'],
            'description' => $data['descrption'],
        ]);
    }

    function getCategories($id)
    {
        $stmt = $this->db->query("SELECT * FROM categories WHERE category_id = :category_id", ['category_id' => $id]);
        return $stmt->fetch();
    }
    function updateCategories($id, $data)
    {
        $this->db->query("UPDATE categories SET name = :name , description = :description WHERE category_id = :category_id",
        [
            'name' => $data['name'],
            'description' => $data['description'],
            'category_id' => $id
        ]);
    }
    function deleteCategories($id)
    {
        $this->db->query("DELETE FROM categories WHERE category_id = :category_id", ['category_id' => $id]);
    }

}
?>
