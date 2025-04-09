<?php
require_once 'Models/stockModel.php';
require_once 'BaseController.php';
require_once 'Models/productModel.php';
class StockController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new StockModel();
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }

        $stocks = $this->model->getAllStock();
        $products = $this->model->getAllProducts();
        $this->view('pages/stock', ['stocks' => $stocks, 'products' => $products]);
    }

     function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $stock = $this->model->getAllProducts();
        $this->view('pages/create', ['stock' => $stock]);
    }  
}
