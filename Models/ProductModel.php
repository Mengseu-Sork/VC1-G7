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
                products.stock_status,   
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

    function createProduct($data) {
        try {
            $stmt = "INSERT INTO products (name, price, category_id, date, image, stock_status) 
                     VALUES (:name, :price, :category_id, :date, :image, :stock_status)";
            $this->db->query($stmt, [
                'name' => $data['name'],
                'price' => $data['price'],
                'category_id' => $data['category_id'],
                'date' => $data['date'],
                'image' => $data['image'],
                'stock_status' => isset($data['stock_status']) ? $data['stock_status'] : 1, // Default to in stock
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Error creating product: " . $e->getMessage());
            return false;
        }
    }

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

    function updateProduct($data){
        try {
            $stmt = "UPDATE products SET 
                    name = :name, 
                    price = :price, 
                    category_id = :category_id, 
                    date = :date";
            
            $params = [
                'name' => $data['name'],
                'price' => $data['price'],
                'category_id' => $data['category_id'],
                'date' => $data['date'],
                'id' => $data['id']
            ];
            
            // Only include image in the update if it's provided
            if (!empty($data['image'])) {
                $stmt .= ", image = :image";
                $params['image'] = $data['image'];
            }
            
            // Include stock status in the update
            if (isset($data['stock_status'])) {
                $stmt .= ", stock_status = :stock_status";
                $params['stock_status'] = $data['stock_status'];
            }
            
            $stmt .= " WHERE id = :id";
            
            $this->db->query($stmt, $params);
            return true;
        } catch (Exception $e) {
            error_log("Error updating product: " . $e->getMessage());
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

    function updateStockStatus($id, $status) {
        try {
            error_log("Model: Updating product ID: $id to stock status: $status");
            
            // Make sure the parameters are of the correct type
            $id = (int)$id;
            $status = (int)$status;
            
            $stmt = "UPDATE products SET stock_status = :stock_status WHERE id = :id";
            $result = $this->db->query($stmt, [
                'id' => $id,
                'stock_status' => $status
            ]);
            
            // Check if any rows were affected
            $success = ($result !== false);
            error_log("Update result: " . ($success ? "success" : "failure"));
            
            return $success;
        } catch (Exception $e) {
            error_log("Error updating stock status: " . $e->getMessage());
            return false;
        }
    }

    function updateBulkStockStatus($ids, $status) {
        try {
            error_log("Model: Updating bulk stock status. IDs: " . (is_string($ids) ? $ids : json_encode($ids)) . ", Status: $status");
            
            // Check if ids is a JSON string and decode it
            if (is_string($ids) && json_decode($ids) !== null) {
                $ids = json_decode($ids);
            }
            
            // Ensure $ids is an array
            if (!is_array($ids)) {
                $ids = [$ids];
            }
            
            // Make sure status is an integer
            $status = (int)$status;
            
            // Create placeholders for the query
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $stmt = "UPDATE products SET stock_status = ? WHERE id IN ($placeholders)";
            $params = array_merge([$status], $ids);
            
            error_log("SQL Query: $stmt");
            error_log("Parameters: " . json_encode($params));
            
            $result = $this->db->query($stmt, $params);
            
            // Check if any rows were affected
            $success = ($result !== false);
            error_log("Bulk update result: " . ($success ? "success" : "failure"));
            
            return $success;
        } catch (Exception $e) {
            error_log("Error updating bulk stock status: " . $e->getMessage());
            return false;
        }
    }
}
?>