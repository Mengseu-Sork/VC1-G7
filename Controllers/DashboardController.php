<?php
require_once 'BaseController.php';
class DashboardController extends BaseController
{

    public function index()
    {
        session_start();
        if (!isset($_SESSION["admin"])) {
            header("Location: /auth/login");
            exit();
        }
    
        $this->view('/Dashboard/list');;
    }
}
