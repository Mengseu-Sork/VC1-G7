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
            $existingUser = $this->model->getUserByEmail($_POST['email']);
            if ($existingUser) {
                echo "Email is already registered. Please use a different email.";
                return;
            }
            $data = [
                'image' => $_POST['image'],
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'password' => $_POST['password']
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
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "Assets/images/uploads/";
                $newFileName = time() . "_" .basename($_FILES["image"]["name"]);
                $targetFile = $targetDir . $newFileName;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    $profileImage = $newFileName;
                } else {
                    $profileImage = $_POST['old_image'];
                }
            } else {
                $profileImage = $_POST['old_image'];
            }

            $data = [
                'image' => $profileImage,
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
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
