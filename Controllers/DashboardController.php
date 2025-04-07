<?php
require_once 'BaseController.php';
class DashboardController extends BaseController
{

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $this->view('/Dashboard/list');
    }
}
