<?php
require_once 'Models/ProductModel.php';
require_once 'BaseController.php';

class ProductController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index() {
        $products = $this->model->getAllProducts();
        $product_types = $this->model->getProductTypes();
        $categories = $this->model->getAllCategories();
        $this->view('Products/Product_list', ['products' => $products, 'product_types' => $product_types, 'categories' => $categories]);
    }
    
    function create(){
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

}
?>

