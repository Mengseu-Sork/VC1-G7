<?php
require_once 'Models/OrderHistoryModel.php';

class OrderHistoryController
{
    private $model;

    public function __construct()
    {
        $this->model = new OrderHistoryModel();
    }

    public function index()
    {
        $orders = $this->model->getAllOrders();
        require 'Views/Products/orderHistory.php';
    }

    public function view($id)
    {
        $order = $this->model->getOrderById($id);
        require 'Views/Products/orderHistoryView.php';
    }

    public function delete($id)
    {
        if ($this->model->deleteOrder($id)) {
            $_SESSION['success'] = "Order deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete order.";
        }
        header('Location: /orderHistory');
        exit();
    }
}
?>
