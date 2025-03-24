<?php
require_once "Models/AdminModel.php";
require_once "BaseController.php";


class AdminController extends BaseController
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function signup()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password_hash"];
            $result = $this->adminModel->login($email, $password);

            if ($result) {
                header("Location: /Dashboard");
                exit();
            }
        }
        require "views/auth/signup.php";
    }
    

    public function signout()
    {
        $this->view('/auth/signout');
    }
    
}
?>
