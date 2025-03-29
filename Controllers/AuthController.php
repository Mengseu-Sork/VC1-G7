<?php
require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/UserModel.php';

class AuthController extends BaseController {
    private $userModel;

    public function __construct() {
        session_start(); // Add this to initialize session
        $this->userModel = new UserModel();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('/dashboard');
        }

        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $this->redirect('/dashboard');
            } else {
                $data['error'] = "Invalid email or password.";
            }
        }

        $this->view('auth/login', $data);
    }

    public function logout() {
        session_start(); // Ensure session is started before destroying
        session_unset();
        session_destroy();
        $this->redirect('/auth/login');
    }
}