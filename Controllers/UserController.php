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
        $this->view('user/list',['users'=>$users]);
    }

    function create()
    {
        $this->view('user/create');
    }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'profile' => $_POST['profile'],
                'name' => $_POST['name'],
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
            $data = [
                'profile' => $_POST['profile'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
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
    

    function show($id)
    {
        $user = $this->model->show($id);
        $this->view('user/detail', ['user' => $user]); 
    }
}
