<?php
require_once 'BaseController.php';
class Authentication extends BaseController {
    function index()
    {
        $this->view("./auth/register.php");
    }
}
?>