<?php
require_once 'Databases/Database.php';

class OrderModel {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database;
    }

    public function insertOrder($user_id, $order_date, $total_amount, $product_name, $quantity) {
        try {
            $this->db->beginTransaction();


            $userCheck = $this->db->query("SELECT id FROM users WHERE id = :user_id", [':user_id' => $user_id]);
            if (!$userCheck->fetch()) {
                $this->db->rollBack();
                return "Error: User does not exist";
            }


            $query = "INSERT INTO orders (user_id, order_date, total_amount, product_name, quantity, price) 
                      VALUES (:user_id, :order_date, :total_amount, :product_name, :quantity, :price)";
            $params = [
                ':user_id' => $user_id,
                ':order_date' => $order_date,
                ':total_amount' => $total_amount,
                ':product_name' => $product_name,
                ':quantity' => $quantity,
                ':price' => $total_amount / max(1, $quantity) 
            ];
            $this->db->query($query, $params);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Error inserting order: " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }
    }

    public function getAllOrders() {
        try {
            $query = "SELECT * FROM orders ORDER BY order_date DESC";
            return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return [];
        }
    }
}
