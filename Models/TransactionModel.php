<?php
require_once 'Databases/Database.php';

class TransactionModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllTransactions() {
        $query = "SELECT 
                    t.transaction_id, 
                    t.product_id, 
                    p.name AS product_name, 
                    t.quantity, 
                    t.transaction_date, 
                    t.transaction_type
                  FROM transactions t
                  LEFT JOIN products p ON t.product_id = p.id
                  ORDER BY t.transaction_date DESC";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }

    public function createTransaction($data) {
        try {
            $stmt = "INSERT INTO transactions (product_id, quantity, transaction_type, transaction_date) 
                     VALUES (:product_id, :quantity, :transaction_type, :transaction_date)";
            $this->db->query($stmt, [
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'transaction_type' => $data['transaction_type'],
                'transaction_date' => $data['transaction_date']
            ]);
            return true;
        } catch (Exception $e) {
            error_log("Error creating transaction: " . $e->getMessage());
            return false;
        }
    }

    public function deleteTransaction($id) {
        try {
            $stmt = "DELETE FROM transactions WHERE transaction_id = :id";
            $this->db->query($stmt, ['id' => $id]);
            return true;
        } catch (Exception $e) {
            error_log("Error deleting transaction: " . $e->getMessage());
            return false;
        }
    }
}
