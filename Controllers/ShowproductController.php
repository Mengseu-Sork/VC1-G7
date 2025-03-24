<?php
require_once 'BaseController.php';
require_once 'Models/ShowproductModel.php';

class ShowproductController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new ShowproductModel();
    }

    public function index() {
        $products = $this->model->getShowProducts();
        $this->view('pages/products', ['products' => $products]);
    }

    // public function show() {
    //     $productId = $_GET['id'] ?? null;
    //     if ($productId) {
    //         $this->model->incrementViewCount($productId); // Increment view count
    //         $product = $this->model->getProductById($productId);
    //         $category = $this->model->getCategoryById($product['category_id']);
    //         if ($product) {
    //             $this->view('pages/show', ['product' => $product, 'category' => $category]);
    //         } else {
    //             $this->view('pages/404');
    //         }
    //     } else {
    //         $this->view('pages/404');
    //     }
    // }
    function show($id = null) {
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
}