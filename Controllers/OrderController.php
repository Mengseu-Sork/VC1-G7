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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header("Location: views/auth/login");
            exit();
        }
        $orders = $this->orderModel->getAllOrders();
        $this->view('pages/order', ['orders' => $orders]);
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rawData = file_get_contents("php://input");
            file_put_contents('debug_log.txt', $rawData . PHP_EOL, FILE_APPEND); // Append for multiple requests
    
            $data = json_decode($rawData, true);
    
            if (!$data) {
                echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
                exit;
            }
    
            if (!isset($data['user_id'], $data['total_amount'], $data['products'])) {
                echo json_encode(['success' => false, 'message' => 'Missing required fields: user_id, total_amount, or products']);
                exit;
            }
    
            $userId = (int) $data['user_id'];
            $totalAmount = (float) $data['total_amount'];
            $products = $data['products'];
    
            // Validate products array
            foreach ($products as $product) {
                if (!isset($product['product_id'], $product['quantity'], $product['subtotal'])) {
                    echo json_encode(['success' => false, 'message' => 'Invalid product data: missing product_id, quantity, or subtotal']);
                    exit;
                }
            }
    
            // Insert Order
            $orderData = [
                'user_id' => $userId,
                'total_amount' => $totalAmount,
                'order_date' => date('Y-m-d H:i:s')
            ];
            $orderID = $this->orderModel->insertOrder($orderData);
    
            if (!$orderID) {
                echo json_encode(['success' => false, 'message' => 'Failed to insert order into database']);
                exit;
            }
    
            // Insert Order Details
            foreach ($products as $product) {
                $result = $this->orderModel->insertOrderDetails(
                    $orderID,
                    (int) $product['product_id'],
                    (int) $product['quantity'],
                    (float) $product['subtotal']
                );
                if (!$result) {
                    echo json_encode(['success' => false, 'message' => 'Failed to insert order details']);
                    exit;
                }
            }
    
            echo json_encode(['success' => true, 'orderID' => $orderID, 'message' => 'Order placed successfully!']);
            exit;
        }
    
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        exit;
    }
}
?>
