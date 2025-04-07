<?php
require_once "Models/AuthModel.php";

class AuthController {
    
    // Register method
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $user = new User();
            $firstName = $_POST['FirstName'];
            $lastName = $_POST['LastName'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $role = 'employee';
            
            if ($user->register($firstName, $lastName, $email, $phone, $password, $role)) {
                header("Location: ../Views/auth/login.php");
                exit();
            } else {
                echo "Registration failed.";
            }
        }

        require_once ('views/auth/register.php'); 
    }

    // Login user
    public function login() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $userModel = new User();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Update login time
                $userModel->updateLoginTime($user['id']);
                
                session_start();
                session_unset();
                session_regenerate_id(true);
                $_SESSION['user'] = $user;
                $_SESSION['login_time'] = date('Y-m-d H:i:s');

                if ($user['role'] === 'admin') {
                    header("Location: /Dashboard");
                } else {
                    header("Location: /Dashboard");
                }
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