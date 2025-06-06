<?php
require_once 'Models/ProductModel.php';
require_once 'Models/OrderModel.php';
require_once 'BaseController.php';

class ProductController extends BaseController {
    private $model;
    private $orderModel;

    public function __construct() {
        $this->model = new ProductModel();
        $this->orderModel = new OrderModel();
    }

    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] === 'application/json') {
            header("Content-Type: application/json");
            $input = file_get_contents("php://input");
            $data = json_decode($input, true);

            if (!$data || !isset($data['user_id']) || !isset($data['total_amount']) || !isset($data['products'])) {
                echo json_encode(["success" => false, "message" => "Invalid order data"]);
                exit;
            }

            $user_id = $data['user_id'];
            $total_amount = $data['total_amount'];
            $products = $data['products'];

            try {
                $orderId = $this->orderModel->createOrder($user_id, $total_amount, $products);
                if ($orderId) {
                    echo json_encode(["success" => true, "message" => "Order placed successfully", "redirect" => "/order/index"]);
                } else {
                    echo json_encode(["success" => false, "message" => "Failed to create order"]);
                }
            } catch (Exception $e) {
                echo json_encode(["success" => false, "message" => "Order failed: " . $e->getMessage()]);
            }
            exit;
        }
        $products = $this->model->getAllProducts();
        $product_types = $this->model->getProductTypes();
        $categories = $this->model->getAllCategories();
        $this->view('Products/Product_list', ['products' => $products, 'product_types' => $product_types, 'categories' => $categories]);
    }

    
    function ratings() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $products = $this->model->getAllProducts();
        $product_types = $this->model->getProductTypes();
        $categories = $this->model->getAllCategories();
        $this->view('Products/Product_ratings', ['products' => $products, 'product_types' => $product_types, 'categories' => $categories]);
    }
    function create(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $categories = $this->model->getAllCategories();
        $this->view('Products/create', ['categories' => $categories]);
    }
    
    function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imageName = null;

            // Handle Image Upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "Assets/images/uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $imageName = basename($_FILES['image']['name']);
                $targetPath = $target_dir . $imageName;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    echo "Error: Failed to upload image.";
                    return;
                }
            }

            // Prepare Data
            $data = [
                'name' => $_POST['name'],
                'price' => floatval($_POST['price']),
                'category_id' => $_POST['type'],
                'date' => $_POST['date-start'],
                'image' => $imageName,
                'description' => isset($_POST['product_content']) ? $_POST['product_content'] : ''
            ];

            // Save Product to Database
            if ($this->model->createProduct($data)) {
                $this->redirect('/products');
            } else {
                echo "Error: Failed to save product.";
            }
        }
    }

    function edit(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = $this->model->getProductById($id);
            if ($product) {
                $categories = $this->model->getAllCategories();
                $this->view('Products/edit', ['product' => $product, 'categories' => $categories]);
            } else {
                echo "Product not found";
                $this->redirect('/products');
            }
        } else {
            $this->redirect('/products');
        }
    }
    
    function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            
            // Image Upload Handling
            $imageName = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "Assets/images/uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $imageName = basename($_FILES['image']['name']);
                $targetPath = $target_dir . $imageName;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    echo "Error: Failed to upload image.";
                    return;
                }
            } else {
                // If no new image is uploaded, keep the existing image
                $product = $this->model->getProductById($id);
                $imageName = $product['image'];
            }

            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'price' => floatval($_POST['price']),
                'category_id' => $_POST['type'],
                'date' => $_POST['date-start'],
                'image' => $imageName,
                'description' => isset($_POST['product_content']) ? $_POST['product_content'] : ''
            ];
            
            if ($this->model->updateProduct($data)) {
                $this->redirect('/products');
            } else {
                echo "Error: Failed to update product.";
            }
        }
    }
    
    function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->model->deleteProduct($id)) {
                $this->redirect('/products');
            } else {
                echo "Error: Failed to delete product.";
            }
        } else {
            $this->redirect('/products');
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
        if ($id === null && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        
        if (!$id) {
            echo "Error: No product ID specified.";
            return;
        }

        $product = $this->model->getProductById($id);

        $category = null;
        if ($product && isset($product['category_id'])) {
            $category = $this->model->getCategoryById($product['category_id']);
        }
        
        // Check if product exists
        if ($product) {
            $this->view('Products/show', [
                'product' => $product,
                'category' => $category
            ]);
        } else {
            $this->view('Products/show', [
                'product' => null,
                'category' => null
            ]);
        }
    }
}
?>