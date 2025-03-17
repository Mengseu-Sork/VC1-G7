<?php
// If BaseController exists

class ProductController extends BaseController {
    private $productModel;

    public function index() {
        $this->view('Products/Product_list');
    }
    function destroy($id)
    {
        if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
           
            $this->redirect('/product');
        }
    }

    
    
}
?>
