<?php
// If BaseController exists
// require_once ' Controllers/BaseController.php';
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
                'category_id' => $_POST['type'],
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

    function edit($id){
        $product = $this->model->getProductById($id);
        if ($product) {
            $this->view('Products/edit', ['product' => $product]);
        } else {
            echo "404 - Product not found";
        }
    }

    function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imagePath = $_POST['existing_image'];
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

            $data = [
                'id' => $id,
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'category_id' => $_POST['type'],
                'date' => $_POST['date-start'],
                'image' => $imagePath,
            ];
            $this->model->updateProduct($data);
            $this->redirect('/products');
        }
    }
}
?>
