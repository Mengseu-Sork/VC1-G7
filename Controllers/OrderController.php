<?php
require_once 'Models/OrderModel.php';
require_once 'BaseController.php';

class OrderController extends BaseController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

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
