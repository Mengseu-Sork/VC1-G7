<?php
session_start();
$users = [
    'email' => 'leap@gmail.com',
    'password' => '12345'
];
class AdminController extends BaseController
{

    function index()
    {
        $this->view('Views/Dashboard/list.php');
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($email === $users['email']){
        if($password === $users['password']){
            $_session['user'] = ['email' => $email, 'password' => $password];
            header('Location: Views/Dashboard/list.php');
            exit();

        }else{
            $_session['error'] = 'password os invalid! try again.';
            require('index.php');
        }
    }else{
        $_session['error'] = "This user doesn't exits.";
        require('views/about.php');
    }
};