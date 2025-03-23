<?php
// If BaseController exists
// require_once ' Controllers/BaseController.php';
require_once './Models/ProductModel.php';
require_once 'BaseController.php';

class ProductController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index() {
        $this->view('Products/product_list');
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productId = $_POST['product_id'];
    
            // Assuming you have a Cart class or a session-based cart:
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
    
            // Add product to cart
            $_SESSION['cart'][] = $productId;
    
            // Redirect to the cart page or back to the product list
            $this->redirect('/cart');
        }
    }
    
    
}
?>
