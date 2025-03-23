<?php

require_once 'Models/ProductModel.php';

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
        // var_dump($categories);
    }
    function create(){
        $this->view('Products/create');
    }
    function store() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imagePath = null;
            
            // Handle Image Upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "Assets/images/uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $imagePath = $target_dir . basename($_FILES['image']['name']);
                
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    echo "Error: Failed to upload image.";
                    return;
                }
            }
            
            // Prepare Data
            $data = [
                'name' => $_POST['name'],
                'price' => floatval($_POST['price']),
                'category_id' => $_POST['category_id'],
                'date' => $_POST['date-start'],
                'image' => $imagePath,
            ];
            
            // Save Product to Database
            if ($this->model->createProduct($data)) {
                $this->redirect('/products');
            } else {
                echo "Error: Failed to save product.";
            }
        }
    }
    function edit($id) {
        $product = $this->model->getProductById($id);
        $categories = $this->model->getAllCategories();
        $this->view('Products/edit', ['product' => $product, 'categories' => $categories]);
    }
    function update($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imagePath = null;
            
            // Handle Image Upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "Assets/images/uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                $imagePath = $target_dir . basename($_FILES['image']['name']);
                
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    echo "Error: Failed to upload image.";
                    return;
                }
            }

            // Prepare Data
            $data = [
                'name' => $_POST['name'],
                'price' => floatval($_POST['price']),
                'category_id' => $_POST['category_id'],
                'date' => $_POST['date-start'],
                'image' => $imagePath,
            ];

            // Update Product in Database
            if ($this->model->updateProduct($id, $data)) {
                $this->redirect('/products');
            } else {
                echo "Error: Failed to update product.";
            }
        }
    }
    function delete($id) {
        if ($this->model->deleteProduct($id)) {
            $this->redirect('/products');
        } else {
            echo "Error: Failed to delete product.";
        }
    }
    function getProductById($id) {
        return $this->model->getProductById($id);
    }
    function getAllCategories() {
        return $this->model->getAllCategories();
    }
    function getAllProducts() {
        return $this->model->getAllProducts();
    }
    function getProductTypes() {
        return $this->model->getProductTypes();
    }
  

}
    

   


?>
