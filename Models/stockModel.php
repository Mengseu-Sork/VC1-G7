<?php
require_once 'Databases/Database.php';

class StockModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllStock() {
        $sql = "SELECT s.*, p.name AS product_name, p.image 
                FROM stock s
                JOIN products p ON s.product_id = p.id";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        $sql = "SELECT id, name, image FROM products WHERE id";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createStock($data) {
        $sql = "INSERT INTO stock (product_id, quantity, last_updated) 
                VALUES (:product_id, :quantity, :last_updated)";
        return $this->db->query($sql, [
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'last_updated' => date('Y-m-d H:i:s')
        ]);
    }

    
    public function getStockById($id) {
        $sql = "SELECT stock.*, products.name AS product_name
                FROM stock
                INNER JOIN products ON stock.product_id = products.id
                WHERE stock.stock_id = :id";
    
        return $this->db->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
    }
    

    public function updateStock($id, $data) {
        $sql = "UPDATE stock 
                SET quantity = :quantity, last_updated = :last_updated 
                WHERE stock_id = :id";
    
        return $this->db->query($sql, [
            'quantity' => $data['quantity'],
            'last_updated' => $data['last_updated'],
            'id' => $id
        ]);
    }
    

    public function stockExistsByProductId($productId) {
        $sql = "SELECT COUNT(*) as count FROM stock WHERE product_id = :product_id";
        $stmt = $this->db->query($sql, ['product_id' => $productId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    
    public function deleteStock($id) {
        $sql = "DELETE FROM stock WHERE stock_id = :id";
        return $this->db->query($sql, ['id' => $id]);
    }
}
