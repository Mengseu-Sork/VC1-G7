<?php
require_once 'Databases/Database.php';

class OrderModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

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

        return $this->db->fetchAll($this->db->query($sql));
    }


    public function getOrderById($id)
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

        // return $this->db->fetch($this->db->query($sql, [':id' => $id]));
        return $this->db->fetch($this->db->query($sql)->execute([":id" => $id]));
    }



    public function deleteOrder($id)
    {
        $sql = "DELETE FROM orders WHERE order_id = :id";
        // return $this->db->query($sql, [':id' => $id])->rowCount() > 0;
        return $this->db->query($sql)->execute([":id" => $id]);
    }
}
?>