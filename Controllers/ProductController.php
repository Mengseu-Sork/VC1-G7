<?php

class ProductController extends BaseController {
    public function index() {
        $this->view('Products/Product_list');
    }
}