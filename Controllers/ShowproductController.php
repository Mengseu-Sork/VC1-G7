<?php
require_once 'BaseController.php';
require_once 'Models/ShowproductModel.php';

class ShowproductController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new ShowproductModel();
    }

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $products = $this->model->getShowProducts();
        $this->view('pages/products', ['products' => $products]);
    }
    function ratings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        // Get product ID from URL if available
        $id = null;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Get the specific product if ID is provided
            $product = $this->model->getProductById($id);
            $this->view('pages/product_ratings', [
                'product' => $product,
                'id' => $id
            ]);
        } else {
            // Get all products if no ID is provided
            $products = $this->model->getShowProducts();
            $this->view('pages/product_ratings', ['products' => $products]);
        }
    }
    function show($id = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        // If no ID is provided in the URL, try to get it from GET parameters
        if ($id === null && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        // Validate that we have an ID
        if (!$id) {
            echo "Error: No product ID specified.";
            return;
        }
        
        // Get product details from the database
        $product = $this->model->getProductById($id);
        
        // Get category information
        $category = null;
        if ($product && isset($product['category_id'])) {
            $category = $this->model->getCategoryById($product['category_id']);
        }
        
        // Check if product exists
        if ($product) {
            // Pass both product and category data to the view
            $this->view('pages/show', [
                'product' => $product,
                'category' => $category
            ]);
        } else {
            // Product not found, still render the view but with no product data
            $this->view('pages/show', [
                'product' => null,
                'category' => null
            ]);
        }
    }
    function incrementViewCount($id) {
        $this->model->incrementViewCount($id);
    }
}