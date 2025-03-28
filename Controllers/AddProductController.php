<?php
// If BaseController exists
// require_once ' Controllers/BaseController.php';
require_once './Models/ProductModel.php';
require_once 'BaseController.php';

class AddProductController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new AddProductModel();
    }

    public function index() {
        $this->view('pages/home');
    }
    function create(){
        $this->view('pages/addProduct');
    }

}
?>
