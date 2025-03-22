<?php
require_once "Models/AdminModel.php";

class AdminController
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
}
?>
