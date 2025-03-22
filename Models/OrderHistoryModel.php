<?php
class OrderHistoryModel
{
    private $db;

    public function __construct()
    {
        include_once __DIR__ . '/../Databases/Database.php';
        $this->db = new Database();
    }

    public function getAllOrders()
    {
        try {
            $sql = "SELECT 
                o.order_id AS id,
                CONCAT(u.FirstName, ' ', u.LastName) AS user_name,
                p.product_name AS product_name,
                od.subtotal AS price,
                o.order_date AS date
            FROM orders o
            LEFT JOIN users u ON o.users_id = u.id
            LEFT JOIN order_detail od ON o.order_id = od.order_id
            LEFT JOIN product p ON od.product_id = p.id
            ORDER BY o.order_date DESC";

            return $this->db->fetchAll($sql);
        } catch (Exception $e) {
            error_log("Error fetching orders: " . $e->getMessage());
            return [];
        }
    }

    public function __destruct()
    {
        $this->db->closeConnection();
    }
}
?>
