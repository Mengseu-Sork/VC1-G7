<?php
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
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
            exit;
        }

        $customer = $input['customer'] ?? null;
        if (!$customer || !isset($customer['first_name'], $customer['last_name'], $customer['email'], $customer['phone'])) {
            echo json_encode(['success' => false, 'message' => 'Missing customer information']);
            exit;
        }

        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $userId = $_SESSION['user']['id'];
        } else {
            $user = $this->orderModel->getUserByEmail($customer['email']);
            if ($user) {
                $userId = $user['id'];
            } else {
                $userId = $this->orderModel->createUser(
                    $customer['first_name'],
                    $customer['last_name'],
                    $customer['email'],
                    $customer['phone']
                );
                if (!$userId) {
                    echo json_encode(['success' => false, 'message' => 'Failed to create user']);
                    exit;
                }
            }
        }
        

        $products = $input['products'] ?? array_map(function ($item) {
            return [
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity']
            ];
        }, $input['cart'] ?? []);

        $totalAmount = $input['total_amount'] ?? $input['total'] ?? 0;

        if (empty($products) || $totalAmount <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid order data: missing products or total']);
            exit;
        }
        $orderId = $this->orderModel->createOrder($userId, $totalAmount, $products);

        if ($orderId) {
            echo json_encode(['success' => true, 'message' => 'Order placed successfully', 'order_id' => $orderId]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to place order']);
        }
        exit;
    }

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
