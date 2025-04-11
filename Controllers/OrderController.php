<?php
// OrderController.php
require_once 'Models/OrderModel.php';
require_once 'BaseController.php';

class OrderController extends BaseController
{
    private $orderModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->orderModel = new OrderModel();
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        if (!isset($_SESSION['user'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'User not authenticated']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
            exit;
        }

        // Transform and validate the input data
        $products = $input['products'] ?? array_map(function ($item) {
            return [
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity']
            ];
        }, $input['cart'] ?? []);
        $totalAmount = $input['total_amount'] ?? $input['total'] ?? 0;

        if (empty($products) || $totalAmount <= 0) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Invalid order data: Missing products or total']);
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $pickupDate = $input['pickup_date'] ?? null;
        $pickupTime = $input['pickup_time'] ?? null;

        $orderId = $this->orderModel->createOrder($userId, $totalAmount, $products, $pickupDate, $pickupTime);
        header('Content-Type: application/json');

        if ($orderId) {
            echo json_encode(['success' => true, 'message' => 'Order placed successfully', 'order_id' => $orderId]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to place order. Please check your order details.']);
        }
        exit;
    }
    // Other methods like index() remain unchanged
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/auth/login');
        }

        $userId = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrdersByUser($userId);
        $this->view('orders/orderHistory', ['orders' => $orders]);
    }
    
}
?>