<?php
require_once "Models/AuthModel.php";

class AuthController{
    
    // Register method
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new User();
            $firstName = $_POST['FirstName'];
            $lastName = $_POST['LastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            
            if ($user->register($firstName, $lastName, $email, $phone, $password)) {
                header("Location: ../Views/auth/login.php");
                exit();
            } else {
                echo "Registration failed.";
            }
        }

        require_once ('views/auth/register.php'); 
    }

    //Lgin user
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $userModel = new User();
            $user = $userModel->getUserByEmail($email);
    
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: /Dashboard");
                exit();
            } else {
                $error = "Invalid email or password.";
                require_once 'views/auth/login.php';
            }
        } else {
            require_once 'views/auth/login.php';
        }
    }


    // Logout method
    public function logout() {
        session_start();
        session_destroy();
        header("Location: Views/auth/login.php");
        exit();
    }
}
?>
