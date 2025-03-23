<?php
require_once  "Models/AuthModel.php";
class AuthController
{
    private $authModel;

    public function __construct()
    {
        $this->authModel = new AuthModel();
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];
    
            $user = $this->authModel->login($email, $password);
            if ($user) {
                $_SESSION["user"] = $user["email"];
                // Redirect to Home Page after login
                header("Location: /");
                exit();
            } else {
                echo "Invalid credentials.";
            }
        }
        require "views/auth/signin.php";
    }
    

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $this->authModel->register($email, $password);
            header("Location: /signin");
        }
        require "auth/register.php";
    }

    public function logout()
    {
        session_destroy();
        header("Location: /signout");
    }
}
?>
