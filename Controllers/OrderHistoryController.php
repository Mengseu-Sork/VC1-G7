<?php
require_once 'Models/OrderHistoryModel.php';
require_once 'BaseController.php';

class OrderHistoryController extends BaseController
{
    private $orderHistoryModel;

    public function __construct()
    {
        $this->orderHistoryModel = new OrderHistoryModel();
    }

    public function index()
    {
        $orders = $this->orderHistoryModel->getAllOrders();

        require_once __DIR__ . '/../Views/Products/orderHistory.php'; 
    }
}
?>
