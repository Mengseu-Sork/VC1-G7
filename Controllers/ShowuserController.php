<?php
require_once 'Models/ShowuserModel.php';
require_once 'BaseController.php';
class ShowuserController extends BaseController
{
    private $model;
    function __construct()
    {
        $this->model =  new ShowuserModel();
    }
    function user()
    {
        $users = $this->model->getUsers();
        $this->view('/profile', ['users'=> $users]);
    }

}
