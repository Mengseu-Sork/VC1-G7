<?php

require_once 'Databases/Database.php';

class StockModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllProducts()
    {
        try {
            $result = $this->db->query("SELECT 
                products.id, 
                products.name,
                products.price, 
                products.date, 
                products.image,
                products.category_id,
                products.stock_status
                FROM products");
            return $result->fetchAll(PDO::FETCH_ASSOC);
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


    public function getProductDetail($id)
    {
        try {
            $query = "SELECT 
                products.id, 
                products.name, 
                stock.last_updated,
                stock.quantity
                FROM products 
                LEFT JOIN stock ON products.id = stock.product_id 
                WHERE products.id = :id";
            $result = $this->db->query($query, ['id' => $id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching product details: " . $e->getMessage());
            return null;
        }
    }
    public function getStockById($id)
    {
        try {
            $query = "SELECT 
                stock.stock_id,
                stock.name AS stock_name,
                products.name AS product_name,
                stock.quantity,
                stock.last_updated
                FROM stock 
                LEFT JOIN products ON stock.product_id = products.id
                WHERE stock.product_id = :id";
            $result = $this->db->query($query, ['id' => $id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching stock by ID: " . $e->getMessage());
            return null;
        }
    }

    public function detailsProduct($id)
    {
        try {
            $query = "SELECT * FROM products WHERE id = :id";
            $result = $this->db->query($query, ['id' => $id]);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching product details: " . $e->getMessage());
            return null;
        }
    }
    public function getProductStock($id)
    {
        try {
            $query = "SELECT 
                    stock.stock_id,
                    COALESCE(stock.name, '(empty)') AS stock_name,
                    products.name AS product_name,
                    stock.product_id,
                    stock.quantity,
                    stock.last_updated
                  FROM stock
                  LEFT JOIN products ON stock.product_id = products.id
                  WHERE stock.product_id = :id";

            $result = $this->db->query($query, ['id' => $id]);
            $stockData = $result->fetch(PDO::FETCH_ASSOC);

            return $stockData ?: [];
        } catch (Exception $e) {
            error_log("Error fetching stock by ID: " . $e->getMessage());
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
                'quantity' => $data['quantity'],
                'last_updated' => date('Y-m-d H:i:s')
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Error creating stock: " . $e->getMessage());
            return false;
        }
    }
    public function updateStock($id, $data)
    {
        try {
            $query = "UPDATE stock SET quantity = :quantity, last_updated = :last_updated WHERE product_id = :id";
            $this->db->query($query, [
                'quantity' => $data['quantity'],
                'last_updated' => date('Y-m-d H:i:s'),
                'id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Error updating stock: " . $e->getMessage());
            return false;
        }
    }
    public function deleteStock($id)
    {
        try {
            $query = "DELETE FROM stock WHERE product_id = :id";
            $this->db->query($query, ['id' => $id]);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting stock: " . $e->getMessage());
            return false;
        }
    }
}
