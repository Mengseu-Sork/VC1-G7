<?php
require_once 'Models/OrderModel.php';
require_once 'BaseController.php';

class OrderController extends BaseController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel(new Database()); 
    }

    public function index() {
        $orders = $this->orderModel->getAllOrders();
        $this->view('orders/index', ['orders' => $orders]);
    }

    public function process() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            header("Content-Type: application/json");

            // Validate inputs
            $productName = $_POST['product_name'] ?? null;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
            $price = isset($_POST['price']) ? (float)$_POST['price'] : 0.0;

            if (!$productName || $quantity <= 0 || $price <= 0) {
                echo json_encode([
                    "success" => false,
                    "message" => "Invalid product details."
                ]);
                exit;
            }

            $total = $quantity * $price;
            $user_id = $_SESSION['user_id'] ?? 1; 
            $order_date = date('Y-m-d');

            $result = $this->orderModel->insertOrder($user_id, $order_date, $total, $productName, $quantity);

            if ($result === true) {
                echo json_encode([
                    "success" => true,
                    "message" => "Order placed successfully for $productName (Quantity: $quantity, Total: $$total)!"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => $result
                ]);
            }
            exit;
        }
    }
}
