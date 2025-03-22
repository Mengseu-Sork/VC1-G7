<?php

require_once 'Models/ShowproductModel.php';

class ShowproductController {
    private $db;

    public function __construct() {
        $this->db = new  ShowproductModel();
    }

    public function show() {
        require_once 'views/pages/products.php';
    }
}