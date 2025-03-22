<?php
// If BaseController exists
// require_once ' Controllers/BaseController.php';
require_once 'Models/ProductModel.php';
require_once 'BaseController.php';

class ProductController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index() {
        $this->view('Products/product_list');
    }
    public function nut() {
        $this->view('Products/product_nut');
    }
    public function flour() {
        $this->view('Products/product_flour');
    }
    // function destroy($id)
    // {
    //     if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
           
    //         $this->redirect('/product');
    //     }
    // }
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
        $this->view('Products/edite', ['product' => $product]);
    }
    function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $data = [
                'product_name' => htmlspecialchars($_POST['product_name']),
                'price' => (float)$_POST['price'],
                'type' => htmlspecialchars($_POST['type']),
                'date' => htmlspecialchars($_POST['date-start']),
            ];
    
            // Image Upload Handling
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $imagePath = $target_dir . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $data['image'] = basename($_FILES['image']['name']); //store only the name in the database.
                    echo "<br> Image Uploaded Correctly <br>";
                } else {
                    echo "Error: Failed to upload image.";
                    return;
                }
            } else {
              //if no new image is uploaded, use the previous image
              $product = $this->model->getProductById($id);
              $data['image'] = $product['image'];
              echo "<br> No new image uploaded, using previous image <br>";
            }
    
            // Validation (Add more validation as needed)
            if (empty($data['product_name'])) {
                echo "Error: Product name is required.";
                return;
            }
    
            var_dump($_FILES['image']);
            echo "<br>";
            if(isset($imagePath)){
                echo "image path: " . $imagePath;
            }
    
            $this->model->updateProduct($id, $data);
            $this->redirect('/products');
        }
    }
    function delete($id)
    {
        $this->model->deleteProduct($id);
        $this->redirect('/products');
    }
}
?>
