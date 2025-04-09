<?php

require_once 'Models/stockModel.php';
require_once 'BaseController.php';

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

    public function show($id)
    {
        $stock = $this->model->getStockById($id);
        if (!$stock) {
            $this->view('pages/detail', ['error' => "Stock not found."]);
            return;
        }
         $this->view('pages/detail', ['stock' => $stock]);
    }
    function detailsProduct($id)
    {
        $product = $this->model->detailsProduct($id);
        if (!$product) {
            $this->view('pages/detail', ['error' => "Product not found."]);
            return;
        }
        $this->view('pages/detail', ['product' => $product]);
    }

}
?>