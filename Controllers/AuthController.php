<?php
require_once 'Models/AuthModel.php';

class AuthController {
    private $model;

    public function __construct() {
        session_start();
        $this->model = new AuthModel();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            header("Location: /dashboard");
            exit;
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
            $password = trim($_POST['password'] ?? '');

            // Validate input fields
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format.';
            } elseif (empty($password)) {
                $error = 'Password is required.';
            } else {
                $user = $this->model->getUserByEmail($email);
                if ($user && password_verify($password, $user['password'])) {
                    session_regenerate_id(true); 
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_email'] = $user['email'];
                    header("Location: /dashboard");
                    exit;
                } else {
                    $error = 'Invalid email or password.';
                }
            }
        }

        $viewPath = __DIR__ . '/../views/auth/login.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            die("Error: View file '$viewPath' not found.");
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: /auth/login");
        exit;
    }
}
?>
