<?php

class ProductController extends BaseController {
    public function product() {
        $this->view('Products/Product_list');
    }
}