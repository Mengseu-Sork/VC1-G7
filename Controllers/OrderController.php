<?php
require_once 'Models/OrderModel.php';
require_once 'BaseController.php';
class OrderController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new OrderModel();
    }

    // Display all orders
    // public function index()
    // {
    //     $orders = $this->model->getOrders();
    //     $this->view('order/orders', ['orders' => $orders]);
    // }

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
   
    private $orderModel;
    public function index() {
        $orders = $this->orderModel->getAllOrders();
        $this->view('orders/index', ['orders' => $orders]);
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderData = [
                'user_id' => $_POST['user_id'], 
                'product_id' => $_POST['product_id'],
                'quantity' => $_POST['quantity'],
                'total_price' => $_POST['total_price'],
                'order_status' => 'pending',
                'order_date' => date('Y-m-d')
            ];

            $orderID = $this->orderModel->insertOrder($orderData);

            if ($orderID) {
                echo json_encode(['success' => true, 'orderID' => $orderID]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to place order']);
            }
        }
    }
}
?>
