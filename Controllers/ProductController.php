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
        $this->view('Products/product_list');
    }
  
    function create(){
        $this->view('Products/create');
    }
    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "uploads/";
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
                'product_name' => $_POST['name'],
                'price' => $_POST['price'],
                'type' => $_POST['type'],
                'date' => $_POST['date-start'],
                'image' => $imagePath,
            ];
            $this->model->createProduct($data);
            $this->redirect('/products');
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
                $target_dir = "uploads/";
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
                'product_name' => $_POST['name'],
                'price' => $_POST['price'],
                'type' => $_POST['type'],
                'date' => $_POST['date-start'],
                'image' => $imagePath,
            ];
            $this->model->updateProduct($data);
            $this->redirect('/products');
        }
    }
}
?>
