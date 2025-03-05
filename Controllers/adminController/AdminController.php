<?php
require_once 'Models/adminModel/AdminModel.php';
require_once __DIR__ . '/../BaseController.php';

class AdminController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model =  new AdminModel();
    }
    function index()
    {
        $admins = $this->model->getAdmins();
        $this->view('../admin_profile.php', ['admins' => $admins]);
    }

    // function create()
    // {
    //     $this->view('user/create');
    // }

    // function store()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $data = [
    //             'profile' => $_POST['profile'],
    //             'name' => $_POST['name'],
    //             'email' => $_POST['email'],
    //             'password' => $_POST['password'],
    //         ];
    //         $this->model->createAdmin($data);
    //         $this->redirect('/user');
    //     }
    // }

    // function edit($id)
    // {
    //     $user = $this->model->getAdmin($id);
    //     $this->view('user/edit',['user'=>$user]);
    // }
    // function update($id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $data = [
    //             'profile' => $_POST['profile'],
    //             'name' => $_POST['name'],
    //             'email' => $_POST['email'],
    //             'password' => $_POST['password'],
    //         ];
    //         $this->model->updateAdmin($id, $data);
    //         $this->redirect('/user');
    //     }
    // }

    // function destroy($id)
    // {
    //     if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
    //         $this->model->deleteAdmin($id);
    //         $this->redirect('/user');
    //     }
    // }
    
    // function show($id)
    // {
    //     $user = $this->model->show($id);
    //     $this->view('user/detail', ['user' => $user]); 
    // }
}
