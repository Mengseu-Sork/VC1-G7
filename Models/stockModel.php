<?php

require_once 'Databases/Database.php';

class StockModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    function getAllProducts() {
        try {
            $result = $this->db->query("SELECT 
                products.id, 
                products.name,
                products.price, 
                products.date, 
                products.image,
                products.category_id
                FROM products");
            return $result->fetchAll();
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return [];
        }
    }
    
    public function getAllStock()
    {
        $query = "SELECT products.id, products.name AS product_name, stock.quantity
                  FROM stock
                  JOIN products ON stock.product_id = products.id";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    function getProductDetail($id) {
        try {
            // Prepare the SQL statement to prevent SQL injection
            $stmt = $this->db->query("SELECT 
                products.id, 
                products.name, 
                products.type, 
                stock.quantity, 
                stock.last_updated 
                FROM products 
                LEFT JOIN stock ON products.id = stock.product_id 
                WHERE products.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        } catch (Exception $e) {
            error_log("Error fetching product details: " . $e->getMessage());
            return null;
        }
    }

    public function getStockById($id)
    {
        // SQL query with a placeholder for the id
        $query = "SELECT products.name AS product_name, stock.quantity 
                  FROM stock 
                  JOIN products ON stock.product_id = products.id
                  WHERE stock.stock_id = :id"; // Ensure this matches the parameter name

        // Execute the query and pass the parameters correctly
        return $this->db->query($query, ['id' => $id])->fetch(PDO::FETCH_ASSOC); // Ensure the 'id' key is used here
    }
    function detailsProduct($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        return $this->db->query($query, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }
}
