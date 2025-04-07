<?php
require_once 'Models/ProfileModel.php';
require_once 'BaseController.php';
class ProfileController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model =  new ProfileModel();
    }

function profile() {
        session_start();
        if (!isset($_SESSION['user'])) {
            
            $this->redirect('/auth/login');
            return;
        }
    
        $userId = $_SESSION['user']['id'];
        $user = $this->model->getUserProfile($userId);
        $this->view('profile/profile', ['user' => $user]);
    }
}