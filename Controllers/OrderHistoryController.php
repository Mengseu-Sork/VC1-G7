<?php
include_once __DIR__ . '/../Models/OrderHistoryModel.php';

class OrderHistoryController
{
    private $orderHistoryModel;

    public function __construct()
    {
        $this->orderHistoryModel = new OrderHistoryModel();
    }

    public function index()
    {
        try {
            $orders = $this->orderHistoryModel->getAllOrders();
            if ($orders === false) {
                $_SESSION['error'] = "Failed to load orders";
            }
            include __DIR__ . '/../Views/orderView.php';
        } catch (Exception $e) {
            $_SESSION['error'] = "An error occurred: " . $e->getMessage();
            include __DIR__ . '/../Views/orderView.php';
        }
    }
}
?>