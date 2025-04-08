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

    function create()
    {
        $stock = $this->model->getAllProducts();
        $this->view('pages/create', ['stock' => $stock]);
    }
    function show($stock_id)
    {
        $stock = $this->model->getStockById($stock_id);
        if ($stock) {
            $this->view('pages/details', ['stock' => $stock]);
        } else {
            echo "Stock not found.";
        }
    }
    function store($data)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'quantity' => $_POST['quantity'],
                'last_updated' => date('Y-m-d H:i:s')
            ];
            $this->model->createStock($data);
            $this->redirect('/pages/stock');
        }
    }
}
