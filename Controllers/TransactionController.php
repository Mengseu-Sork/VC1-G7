<?php
require_once 'Models/TransactionModel.php';
require_once 'Models/ProductModel.php';
require_once 'BaseController.php';

class TransactionController extends BaseController {
    private $model;
    private $productModel;

    public function __construct() {
        $this->model = new TransactionModel();
        $this->productModel = new ProductModel();
    }

    public function index() {
        $transactions = $this->model->getAllTransactions();
        $products = $this->productModel->getAllProducts();
        $this->view('Transactions/transaction_list', [
            'transactions' => $transactions,
            'products' => $products
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'transaction_type' => $_POST['transaction_type'],
                'transaction_date' => $_POST['transaction_date'] ?? date('Y-m-d')
            ];

            if ($this->model->createTransaction($data)) {
                $this->redirect('/transactions');
            } else {
                echo "Error: Failed to create transaction.";
            }
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->model->deleteTransaction($id)) {
                $this->redirect('/transactions');
            } else {
                echo "Error: Failed to delete transaction.";
            }
        }
    }
}
