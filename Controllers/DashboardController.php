<?php
require_once 'BaseController.php';
require_once 'Models/DashboardModel.php';
class DashboardController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model =  new DashboardModel();
    }

    public function index()
    {
        // Start session if it's not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Redirect to login if user not logged in
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
    
        // Load products and count
        $totalProducts = $this->model->getProductCount();
        $totalStockQuantity = $this->model->getTotalStockQuantity();
        $totalOrders = $this->model->getTotalOrder();
        $totalRevenue = $this->model->getTotalOrderPrice();

        // Pass data to view
        $this->view('Dashboard/list', [
            "totalProducts" => $totalProducts,
            "totalStockQuantity" => $totalStockQuantity,
            "totalOrders" => $totalOrders,
            "totalRevenue" => $totalRevenue
        ]);
    }   
}
