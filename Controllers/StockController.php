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
        $stocks = $this->model->getAllStock();
        $products = $this->model->getAllProducts();
        $this->view('pages/stock', ['stocks' => $stocks, 'products' => $products]);
       
    }
    public function create()
    {
        $stock = $this->model->getAllProducts();
        $this->view('pages/create', ['stock' => $stock]);
    }
    function update($id)
    {
        $stock = $this->model->getStockById($id);
        if (!$stock) {
            $this->view('pages/detail', ['error' => "Stock not found."]);
            return;
        }
        $this->view('pages/update', ['stock' => $stock]);
    }
    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'category_id' => $_POST['category_id'], 
                'last_updated' => date('Y-m-d H:i:s')
            ];
    
            if ($this->model->createStock($data)) {
                header("Location: /pages/stock");
                exit;
            } else {
                echo "Error: Failed to create stock.";
            }
        }
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
        $this->view('pages/detail', ['stock' => $product]); // Use 'stock' key
    }
    function getProductStock($id)
    {
        $product = $this->model->getProductStock($id);
        if (!$product) {
            $this->view('pages/detail', ['error' => "Product not found."]);
            return;
        }
        $this->view('pages/detail', ['stock' => $product]); // Use 'stock' key
    }
}
