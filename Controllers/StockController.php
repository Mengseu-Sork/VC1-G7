<?php
require_once 'Models/StockModel.php';
require_once 'BaseController.php';

class StockController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new StockModel();
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /auth/login");
            exit();
        }

        $stocks = $this->model->getAllStock();
        $this->view('stock/stock', ['stocks' => $stocks]);
    }

    public function create() {
        session_start();
        if (!isset($_SESSION['user'])) {
            
            $this->redirect('/auth/login');
            return;
        }
        $products = $this->model->getAllProducts();
        $this->view('stock/create', ['products' => $products]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'];
    
            if ($this->model->stockExistsByProductId($productId)) {
                $_SESSION['error'] = "Stock for this product already exists.";
                $this->redirect('/stock/create');
                return;
            }
    
            $data = [
                'product_id' => $productId,
                'quantity' => $_POST['quantity'],
                'last_updated' => $_POST['last_updated']
            ];
    
            $this->model->createStock($data);
            $this->redirect('/stock');
        }
    }
    

    public function edit() {
        session_start();
        if (!isset($_SESSION['user'])) {
            
            $this->redirect('/auth/login');
            return;
        }
        
        $stockId = $_GET['id'] ?? null;
        if (!$stockId) {
            $this->redirect('/stock');
        }
    
        $stock = $this->model->getStockById($stockId);
    
        $this->view('stock/edit', [
            'stock' => $stock,
        ]);
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['stock_id'];
            $data = [
                'quantity' => $_POST['quantity'],
                'last_updated' => $_POST['last_updated']
            ];
    
            $this->model->updateStock($id, $data);
            $this->redirect('/stock');
        }
    }
    
    public function delete() {
        if (isset($_GET['id'])) {
            $this->model->deleteStock($_GET['id']);
        }
        $this->redirect('/stock');
    }
}
