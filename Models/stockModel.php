<?php

require_once 'Databases/Database.php';

class StockModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAllStock()
    {
        try {
            $query = "SELECT stock_id, name, product_id, quantity, last_updated FROM stock";
            $result = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
            error_log("Fetched stock data: " . print_r($result, true));
            return $result;
        } catch (Exception $e) {
            error_log("Error fetching stock: " . $e->getMessage());
            return [];
        }
    }
    public function getAllProducts()
    {
        try {
            $query = "SELECT 
                id, 
                name,
                price, 
                stock_status
                FROM products";
            $result = $this->db->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return [];
        }
    }
    public function createStock($data)
    {
        try {
            $query = "INSERT INTO stock (product_id, quantity, last_updated) 
                      VALUES (:product_id, :quantity, :last_updated)";
            $this->db->query($query, [
                'product_id' => $data['product_id'],
                'quantity' => (int)$data['quantity'],
                'last_updated' => date('Y-m-d H:i:s')
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Error creating stock: " . $e->getMessage());
            return false;
        }
    }
}
