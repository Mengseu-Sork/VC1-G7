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
            error_log("Error fetching products: " . $e->getMessage());
            return [];
        }
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

    // public function createProduct($data) {
    //     try {
    //         $query = "INSERT INTO products (name, price, category_id, date, image, description) 
    //                   VALUES (:name, :price, :category_id, :date, :image, :description)";
            
    //         $params = [
    //             'name' => $data['name'],
    //             'price' => $data['price'],
    //             'category_id' => $data['category_id'],
    //             'date' => $data['date'],
    //             'image' => $data['image'],
    //             'description' => $data['description']
    //         ];
            
    //         $this->db->query($query, $params);
    //         return $this->db->lastInsertId();
    //     } catch (Exception $e) {
    //         error_log("Error creating product: " . $e->getMessage());
    //         return false;
    //     }
    // }

    function getProductById($id){
        try {
            $query = "SELECT * FROM products WHERE id = :id";
            $result = $this->db->query($query, ['id' => $id]);
            return $result->fetch();
        } catch (Exception $e) {
            error_log("Error getting product by ID: " . $e->getMessage());
            return false;
        }
    }

    // function updateProduct($data){
    //     try {
    //         $stmt = "UPDATE products SET 
    //                 name = :name, 
    //                 price = :price, 
    //                 category_id = :category_id, 
    //                 date = :date";
            
    //         $params = [
    //             'name' => $data['name'],
    //             'price' => $data['price'],
    //             'category_id' => $data['category_id'],
    //             'date' => $data['date'],
    //             'id' => $data['id']
    //         ];
            
    //         // Only include image in the update if it's provided
    //         if (!empty($data['image'])) {
    //             $stmt .= ", image = :image";
    //             $params['image'] = $data['image'];
    //         }
            
    //         $stmt .= " WHERE id = :id";
            
    //         $this->db->query($stmt, $params);
    //         return true;
    //     } catch (Exception $e) {
    //         error_log("Error updating product: " . $e->getMessage());
    //         return false;
    //     }
    // }
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
    
    function deleteProduct($id){
        try {
            $stmt = "DELETE FROM products WHERE id = :id";
            $this->db->query($stmt, ['id' => $id]);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting product: " . $e->getMessage());
            return false;
        }
    }
    // Inside the createProduct method of ProductModel.php
public function createProduct($data)
{
    try {
        $sql = "INSERT INTO products (name, price, category_id, date, image) 
                VALUES (:name, :price, :category_id, :date, :image)";
        
        $params = [
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':category_id' => $data['category_id'],
            ':date' => $data['date'],
            ':image' => $data['image']
        ];
        
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    } catch (Exception $e) {
        error_log("Error creating product: " . $e->getMessage());
        return false;
    }
}

// Inside the updateProduct method of ProductModel.php
public function updateProduct($data)
{
    try {
        $sql = "UPDATE products 
                SET name = :name, price = :price, category_id = :category_id, 
                    date = :date, image = :image 
                WHERE id = :id";
        
        $params = [
            ':id' => $data['id'],
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':category_id' => $data['category_id'],
            ':date' => $data['date'],
            ':image' => $data['image']
        ];
        
        $this->db->query($sql, $params);
        return true;
    } catch (Exception $e) {
        error_log("Error updating product: " . $e->getMessage());
        return false;
    }
}

    // function incrementViewCount($id) {
    //     try {
    //         $stmt = "UPDATE products SET views = views + 1 WHERE id = :id";
    //         $this->db->query($stmt, ['id' => $id]);
    //     } catch (Exception $e) {
    //         error_log("Error incrementing view count: " . $e->getMessage());
    //     }
    // }



    
}
?>

