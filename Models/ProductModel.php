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

    public static function find($id) {
        $db = new Database();
        return $db->query("SELECT * FROM products WHERE id = ?", [$id])->fetch();
    }

    public static function update($id, $name, $price, $date, $type, $image) {
        $db = new Database();
        $query = "UPDATE products SET name = ?, price = ?, date = ?, type = ?, image = ? WHERE id = ?";
        return $db->query($query, [$name, $price, $date, $type, $image, $id]);
    }

    // function getProductById($id){
    //     $query = "SELECT * FROM products WHERE id = :id";
    //     $result = $this->db->query($query, ['id' => $id]);
    //     return $result->fetch();
    // }

    function updateProduct($id, $data) {
        try {
            $query = "UPDATE products SET name = :name, price = :price, category_id = :category_id, date = :date";
            
            // Only include image in update if it's provided
            if (!empty($data['image'])) {
                $query .= ", image = :image";
            }
            
            $query .= " WHERE id = :id";
            
            $params = [
                'name' => $data['name'],
                'price' => $data['price'],
                'category_id' => $data['category_id'],
                'date' => $data['date'],
                'id' => $id
            ];
            
            // Only add image parameter if it exists
            if (!empty($data['image'])) {
                $params['image'] = $data['image'];
            }
            
            // Execute the query with parameters
            $result = $this->db->query($query, $params);
            
            return $result !== false;
        } catch (Exception $e) {
            error_log("Error updating product: " . $e->getMessage());
            return false;
        }
    }
    function deleteProduct($id){
        $stmt =$this->db->query("DELETE FROM products WHERE id = :id");
        $this->db->query($stmt, ['id' => $id]);
    }
    function getProductById($id) {
        try {
            // Use prepared statement to prevent SQL injection
            $query = "SELECT * FROM products WHERE id = :id";
            $result = $this->db->query($query, ['id' => $id]);
            
            // Fetch the product
            $product = $result->fetch();
            
            // For debugging
            if (!$product) {
                error_log("No product found with ID: $id");
            }
            
            return $product;
        } catch (Exception $e) {
            error_log("Error fetching product by ID: " . $e->getMessage());
            return null;
        }
    }
    
    function getCategoryById($categoryId) {
        try {
            $query = "SELECT * FROM categories WHERE category_id = :category_id";
            $result = $this->db->query($query, ['category_id' => $categoryId]);
            return $result->fetch();
        } catch (Exception $e) {
            error_log("Error fetching category: " . $e->getMessage());
            return null;
        }
    }
    
}
?>