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

    }
    
    function create()
    {
        $this->view('categories/create');
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'descript' => $_POST['descript']
            ];
            $this->model->createCategories($data);
            $this->redirect('/categories');
        }
    }

    function edit($id)
    {
        $categories = $this->model->getCategories($id);
        $this->view('categories/edit',['categories'=>$categories]);

    }
    function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'descript' => $_POST['descript']
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
