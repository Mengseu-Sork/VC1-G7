<?php
require_once 'Models/OrderModel.php';
require_once 'BaseController.php';

class PaymentController extends BaseController
{
    private $orderModel;

    public function __construct()
    {
       
        $this->orderModel = new OrderModel();
    }
    function payment()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $orders= $this->orderModel->getorder();
        $this->view( '/payments/payment', ['orders' => $orders]);
    }

   
}