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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $users = $this->model->getUsers();
        $this->view('user/users',['users'=>$users]);
    }

    function create()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
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
                'role' => $_POST['role'],
                'password' => $_POST['password']
            ];
            $this->model->createUser($data);
            $this->redirect('/user');
        }
    }

    function edit($id)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user = $this->model->getUser($id);
        $this->view('user/edit',['user'=>$user]);
    }


    
    function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            
            // Image Upload Handling
            $profileImage = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $target_dir = "Assets/images/uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $profileImage = basename($_FILES['image']['name']);
                $targetPath = $target_dir . $profileImage;
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    echo "Error: Failed to upload image.";
                    return;
                }
            } else {
                // If no new image is uploaded, keep the existing image
                $user = $this->model->getUsers($id);
                $profileImage = $user['image'];
            }

            $data = [
                'image' => $profileImage,
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'role' => $_POST['role'],
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
