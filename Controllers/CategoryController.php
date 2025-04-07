<?php
require_once 'Models/CategoryModel.php';

class CategoryController extends BaseController {
    private $model;

    public function __construct() {
        $this->model = new CategoryModel();
    }


    // Display the categories
    public function index(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $categories = $this->model->getAllCategories();
        $this->view('categories/category_list',['categories' => $categories]); 

    }
    
    function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->view('categories/create');
    }

    function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description']
            ];
            $this->model->createCategories($data);
            $this->redirect('/categories');
        }
    }
    

    function edit($id)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $category = $this->model->getCategories($id); 
        $this->view('categories/edit', ['category' => $category]); 
    }

function update()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Category ID is missing.");
        }

        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description']
        ];
        
        $this->model->updateCategories($id, $data);
        $this->redirect('/categories');
    }
}


    function destroy($id)
    {
        $this->model->deleteCategories($id);
        $this->redirect('/categories');
    }
}
?>
