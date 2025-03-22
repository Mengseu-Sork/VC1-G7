<?php
require_once 'Databases/Database.php'; 

class OrderHistoryModel
{
    private $pdo;

    public function __construct()
    {
        // Initialize the Database class, which manages the PDO connection
        $this->pdo = new Database();
    }

    // Get all orders
    public function getAllOrders()
    {
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
        
        $stmt = $this->pdo->query($sql);  // Execute the query using the Database class
        return $this->pdo->fetchAll($stmt);  // Fetch all results
    }

    // Get details of a single order by its ID
    public function show($id)
    {
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
                WHERE o.order_id = :id";
        
        $stmt = $this->pdo->query($sql, [":id" => $id]);  // Pass parameter for order ID
        return $this->pdo->fetch($stmt);  // Fetch the single result
    }

    // Delete an order by ID
    public function delete($id): bool
    {
        $sql = "DELETE FROM orders WHERE order_id = :id";
        $stmt = $this->pdo->query($sql, [":id" => $id]);  // Execute the delete query
        return $stmt->rowCount() > 0;  // Return true if deletion was successful
    }
}

?>
