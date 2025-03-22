<?php
require_once 'Models/OrderModel.php';

class OrderController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new OrderModel();
    }

    // Display all orders
    public function index()
    {
        $orders = $this->model->getOrders();
        $this->view('order/orders', ['orders' => $orders]);
    }

    // // Show the order creation form
    // public function create()
    // {
    //     $products = $this->model->getAllProducts(); // Fetch available products
    //     $this->view('order/create', ['products' => $products]);
    // }

    // // Store a new order in the database
    // public function store()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = [
    //             'product_id'  => $_POST['product_id'],
    //             'quantity'    => $_POST['quantity'],
    //             'total_price' => $_POST['total_price'],
    //             'order_date'  => date('Y-m-d')
    //         ];

    //         $this->model->createOrder($data);
    //         $this->redirect('/orders');
    //     }
    // }
}
?>
