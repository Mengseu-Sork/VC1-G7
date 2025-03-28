<?php
require_once 'Models/ProductModel.php';
// require_once 'Models/NotificationModel.php';
require_once 'BaseController.php';

class ProductController extends BaseController {
    private $model;
    // private $notificationModel;

    public function __construct() {
        $this->model = new ProductModel();
        // $this->notificationModel = new NotificationModel();
    }

    public function index() {
        $products = $this->model->getAllProducts();
        $product_types = $this->model->getProductTypes();
        $categories = $this->model->getAllCategories();
        $this->view('Products/Product_list', ['products' => $products, 'product_types' => $product_types, 'categories' => $categories]);
    }
    
    function ratings() {
        $products = $this->model->getAllProducts();
        $product_types = $this->model->getProductTypes();
        $categories = $this->model->getAllCategories();
        $this->view('Products/Product_ratings', ['products' => $products, 'product_types' => $product_types, 'categories' => $categories]);
    }
    
    function create(){
        $categories = $this->model->getAllCategories();
        $this->view('Products/create', ['categories' => $categories]);
    }
    public function store() {
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
                'description' => isset($_POST['product_content']) ? $_POST['product_content'] : '',
                'stock_status' => isset($_POST['stock_status']) ? $_POST['stock_status'] : 1 // Default to in stock
            ];
    
            // Save Product to Database
            if ($productId = $this->model->createProduct($data)) {
                // Create notification for the new product
                $message = "New product '{$data['name']}' has been added";
                // $this->notificationModel->createNotification($message, $productId, 'product');
                
                $this->redirect('/products');
            } else {
                echo "Error: Failed to save product.";
            }
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
                'description' => isset($_POST['product_content']) ? $_POST['product_content'] : '',
                'stock_status' => isset($_POST['stock_status']) ? $_POST['stock_status'] : 1
            ];
            
            if ($this->model->updateProduct($data)) {
                // Create notification for the updated product
                $message = "Product '{$data['name']}' has been updated";
                // $this->notificationModel->createNotification($message, $id, 'product');
                
                $this->redirect('/products');
            } else {
                echo "Error: Failed to update product.";
            }
        }
    }

   
    function edit(){
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

    function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = $this->model->getProductById($id);
            
            if ($product && $this->model->deleteProduct($id)) {
                // Create notification for the deleted product
                $message = "Product '{$product['name']}' has been deleted";
                // $this->notificationModel->createNotification($message, null, 'product');
                
                $this->redirect('/products');
            } else {
                echo "Error: Failed to delete product.";
            }
        } else {
            $this->redirect('/products');
        }
    }
    
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
            $this->view('Products/show', [
                'product' => $product,
                'category' => $category
            ]);
        } else {
            // Product not found, still render the view but with no product data
            $this->view('Products/show', [
                'product' => null,
                'category' => null
            ]);
        }
    }

    function updateStock() {
        // Debug information
        error_log("updateStock method called");
        error_log("POST data: " . json_encode($_POST));
        
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['stock_status'])) {
            $id = $_POST['id'];
            $status = $_POST['stock_status'];
            
            error_log("Updating product ID: $id to stock status: $status");
            
            if ($this->model->updateStockStatus($id, $status)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update stock status']);
            }
            exit;
        }
        error_log("Invalid request to updateStock");
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit;
    }

    function updateBulkStock() {
        // Debug information
        error_log("updateBulkStock method called");
        error_log("POST data: " . json_encode($_POST));
        
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ids']) && isset($_POST['stock_status'])) {
            $ids = $_POST['ids'];
            $status = $_POST['stock_status'];
            
            error_log("Updating products with IDs: $ids to stock status: $status");
            
            if ($this->model->updateBulkStockStatus($ids, $status)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update stock status']);
            }
            exit;
        }
        error_log("Invalid request to updateBulkStock");
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit;
    }
}
?>
