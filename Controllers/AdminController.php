<?php
require_once 'Models/AdminModel.php';
require_once 'BaseController.php';

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
        $this->view('admin/profile',['admins'=>$admins]);
    }

    // function create()
    // {
    //     $this->view('user/create');
    // }

    function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'profile' => $_POST['profile'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password_hash' => $_POST['password_hash'],
            ];
            $this->model->createAdmin($data);
            $this->redirect('/admin');
        }
    }

    function edit($id)
    {
        $admin = $this->model->getAdmin($id);
        $this->view('admin/editProfile',['admin'=>$admin]);
    }
    function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'profile' => $_POST['profile'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password_hash' => $_POST['password_hash'],
            ];
            $this->model->updateAdmin($id, $data);
            $this->redirect('/admin');
        }
    }

    function destroy($id)
    {
        if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
            $this->model->deleteAdmin($id);
            $this->redirect('/admin');
        }
    }
}
