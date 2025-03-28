<?php

require_once './Models/ProductModel.php'; // Path to your product model
require_once 'BaseController.php';          // Path to your base controller

class ViewProductController extends BaseController {

    private $model;

    public function __construct() {
        $this->model = new ViewProductModel(); // Create an instance of your product model
    }

    public function view($id) {
        // 1. Retrieve the product data from the model
        $product = $this->model->getProductById($id);

        // 2. Pass the data to the view
        $this->view('pages/viewProduct', ['product' => $product]);
    }

    // Other controller methods for product-related actions (e.g., create, update, delete)
    // ...
}

?>