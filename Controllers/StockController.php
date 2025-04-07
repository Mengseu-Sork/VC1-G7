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
        
        $stocks = $this->model->getAllStock();
        $products = $this->model->getAllProducts();
        $this->view('pages/stock', ['stocks' => $stocks, 'products' => $products]);
    }

     function create()
    {
        $stock = $this->model->getAllProducts();
        $this->view('pages/create', ['stock' => $stock]);
    }  
}
