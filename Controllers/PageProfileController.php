<?php
require_once 'Models/PageProfileController.php';
require_once 'BaseController.php';
class UserController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model =  new UserModel();
    }
function edit($id)
    {
        $user = $this->model->getUser($id);
        $this->view('pages/edit',['user'=>$user]);
    }
    function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "/Assets/images/";
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
                'password' => $_POST['password'],
            ];

            $this->model->updateUser($id, $data);
            $this->redirect('/pages');
        }
    }

    function show($id)
    {
        $user = $this->model->show($id);
        $this->view('pages/detail', ['user' => $user]); 
    }
}