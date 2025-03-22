<?php
require_once 'Models/UserModel.php';
require_once 'BaseController.php';
class UserController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model =  new UserModel();
    }
    function index()
    {
        $users = $this->model->getUsers();
        $this->view('user/users',['users'=>$users]);
    }

    function create()
    {
        $this->view('user/create');
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'image' => $_POST['image'],
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];
            $this->model->createUser($data);
            $this->redirect('/user');
        }
    }

    function edit($id)
    {
        $user = $this->model->getUser($id);
        $this->view('user/edit',['user'=>$user]);
    }
    function update($id)
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
                'image' => $imagePath,
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
            ];

            $this->model->updateUser($id, $data);
            $this->redirect('/user');
        }
    }


    function destroy($id)
    {
        $this->model->deleteUser($id);
        $this->redirect('/user');
    }

    function show($id)
    {
        $user = $this->model->show($id);
        $this->view('user/detail', ['user' => $user]); 
    }
}
