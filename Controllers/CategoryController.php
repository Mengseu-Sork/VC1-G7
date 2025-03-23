<?php
require_once 'Models/CategoryModel.php';

class CategoryController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new CategoryModel();
    }


    // Display the categories
    public function index(){
        $categories = $this->model->getAllCategories();
        $this->view('categories/category_list',['categories' => $categories]); 
        // echo "Category List";
        // var_dump($categories);

    }
    
}
?>
