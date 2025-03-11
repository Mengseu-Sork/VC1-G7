<?php

require_once 'Models/loginModel.php';
require_once 'BaseController.php';

class LoginController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model =  new LoginModel();
    }
    function index()
    {
        $users = $this->model->getUsers();
        $this->view('user/profile_user',['users'=>$users]);
    }
    function create()
    {
        $this->view('user/create');
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'FisrtName' => $_POST['FisrtName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'image' => $_POST['image'],
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
            $data = [
                'FisrtName' => $_POST['FisrtName'],
                'LastName' => $_POST['LastName'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'image' => $_POST['image'],

            ];
            $this->model->updateUser($id, $data);
            $this->redirect('/user');
        }
    }

    function destroy($id)
    {
        if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
            $this->model->deleteUser($id);
            $this->redirect('/user');
        }
    }
}
