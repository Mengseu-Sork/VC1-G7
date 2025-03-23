<?php
require_once 'BaseController.php';
require_once 'Models/ShowproductModel.php';

class ShowproductController extends BaseController {
    private $db;

    public function __construct() {
        $this->db = new  ShowproductModel();
    }

    public function show() {
        $this->view('/pages/products');
    }
}