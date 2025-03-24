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
            $user = $this->model->getUser($id);
            $imagePath = $user['image'];
    
            // Check if a new image is uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                // Define the upload directory
                $target_dir = "Assets/images/uploads/";
    
                // Create the directory if it doesn't exist
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
    
                // Generate a unique name for the image to prevent overwriting
                $imagePath = $target_dir . time() . '-' . basename($_FILES['image']['name']);
    
                // Move the uploaded file to the target directory
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    echo "Error: Failed to upload image.";
                    return;
                }
            }
    
            // Prepare the data to update
            $data = [
                'image' => $imagePath,
                'FirstName' => $_POST['FirstName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'], // Ensure password is securely handled
            ];
    
            // Update the user in the database
            $this->model->updateUser($id, $data);
    
            // Redirect to user listing page after update
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
