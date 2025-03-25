<?php
require_once 'Models/OrderModel.php'; 
require_once 'BaseController.php';

class OrderController extends BaseController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    public function placeOrder() {
        header("Content-Type: application/json");

        try {
            $input = json_decode(file_get_contents('php://input'), true);
            $productId = $input['productId'] ?? null;
            $quantity = $input['quantity'] ?? 1;
            $total = $input['total'] ?? 0;

            if (!$productId || $quantity < 1 || $total <= 0) {
                echo json_encode(["success" => false, "message" => "Invalid order details"]);
                exit;
            }

            $product = $this->orderModel->getProductById($productId);
            if (!$product) {
                echo json_encode(["success" => false, "message" => "Product not found"]);
                exit;
            }

            if ($product['stock_quantity'] < $quantity) {
                echo json_encode(["success" => false, "message" => "Not enough stock available."]);
                exit;
            }

            $userId = $_SESSION['user_id'] ?? null;
            if (!$userId) {
                echo json_encode(["success" => false, "message" => "User not logged in"]);
                exit;
            }

            $_SESSION['success'] = "Order placed successfully!";
            echo json_encode(["success" => true, "message" => "Order placed successfully!"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "An error occurred: " . $e->getMessage()]);
        }
    }

    public function showOrderPage() {
        $orders = $this->orderModel->getAllOrders();
        require_once __DIR__ . '/../views/pages/order.php';
    }
}
?>
