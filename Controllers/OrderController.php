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

        // Log the raw input for debugging
        $rawInput = file_get_contents('php://input');
        error_log("Order input received: " . $rawInput);

        $input = json_decode($rawInput, true);
        if (!$input) {
            echo json_encode(['success' => false, 'message' => 'Invalid JSON data: ' . json_last_error_msg()]);
            exit;
        }

        // Log the decoded input
        error_log("Decoded input: " . print_r($input, true));

        $customer = $input['customer'] ?? null;
        if (!$customer || !isset($customer['first_name'], $customer['last_name'], $customer['email'], $customer['phone'])) {
            echo json_encode(['success' => false, 'message' => 'Missing customer information']);
            exit;
        }

        // Get or create user
        try {
            // Always try to get or create a user based on email
            $user = $this->orderModel->getUserByEmail($customer['email']);
            if ($user) {
                $userId = $user['id'];
                error_log("Found existing user with ID: " . $userId);
            } else {
                error_log("Creating new user with email: " . $customer['email']);
                $userId = $this->orderModel->createUser(
                    $customer['first_name'],
                    $customer['last_name'],
                    $customer['email'],
                    $customer['phone']
                );
                
                if (!$userId) {
                    throw new Exception("Failed to create user");
                }
                error_log("Created new user with ID: " . $userId);
            }
            
            // Process products from cart
            $products = [];
            if (isset($input['cart']) && is_array($input['cart'])) {
                foreach ($input['cart'] as $item) {
                    if (isset($item['product_id'], $item['quantity'], $item['price'])) {
                        $products[] = [
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'subtotal' => $item['price'] * $item['quantity'],
                            'check_stock' => true
                        ];
                    }
                }
                error_log("Processed " . count($products) . " products from cart");
            } elseif (isset($input['products']) && is_array($input['products'])) {
                $products = $input['products'];
                error_log("Using " . count($products) . " products directly from input");
            }

            if (empty($products)) {
                throw new Exception("No products in order");
            }

            $totalAmount = $input['total_amount'] ?? $input['total'] ?? 0;
            error_log("Total amount: " . $totalAmount);

            if ($totalAmount <= 0) {
                throw new Exception("Invalid total amount");
            }

            // Create the order with customer information
            $orderId = $this->orderModel->createOrder(
                $userId, 
                $totalAmount, 
                $products, 
                $customer['first_name'],
                $customer['last_name'],
                $customer['phone'],
                $customer['email']
            );
            
            if ($orderId) {
                error_log("Order created successfully with ID: " . $orderId);
                echo json_encode(['success' => true, 'message' => 'Order placed successfully', 'order_id' => $orderId]);
            } else {
                error_log("Failed to create order - returned false from OrderModel");
                echo json_encode(['success' => false, 'message' => 'Failed to place order']);
            }
            
        } catch (Exception $e) {
            error_log("Exception in order process: " . $e->getMessage());
            echo json_encode([
                'success' => false, 
                'message' => 'Error: ' . $e->getMessage(),
                'debug' => [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'input' => $input
                ]
            ]);
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
