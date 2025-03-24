<?php
require_once 'Models/OrderModel.php';

class OrderController
{
    private $model;

    public function __construct()
    {
        $this->model = new OrderModel();
    }

    public function index()
    {
        $orders = $this->model->getAllOrders();
        require 'Views/pages/order.php'; // Ensure the path is correct
    }

    public function view($id)
    {
        if (!isset($id) || empty($id)) {
            $_SESSION['error'] = "Invalid order ID.";
            header('Location: /orders');
            exit();
        }

        $order = $this->model->getOrderById($id);
        require 'Views/pages/order.php'; // Ensure the path is correct
    }

    public function delete($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($id) || empty($id)) {
            $_SESSION['error'] = "Invalid order ID.";
            header('Location: /orders');
            exit();
        }

        if ($this->model->deleteOrder($id)) {
            $_SESSION['success'] = "Order deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete order.";
        }
        header('Location: /orders');
        exit();
    }
}
?>
