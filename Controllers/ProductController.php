<?php
// If BaseController exists

class ProductController extends BaseController {
    private $productModel;

    public function index() {
        $this->view('Products/Product_list');
    }
    public function nut() {
        $this->view('Products/product_nut');
    }
    public function flour() {
        $this->view('Products/product_flour');
    }
    function destroy($id)
    {
        if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
           
            $this->redirect('/product');
        }
    }
    
}
?>
