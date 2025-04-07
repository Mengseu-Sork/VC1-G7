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
        $this->view('pages/orderHistory', ['orders' => $orders]);
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendJsonResponse(false, 'Invalid request method', 405);
            return;
        }

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData, true);

        error_log("Received order data: " . print_r($data, true));

        if (!$data || !isset($data['user_id'], $data['total_amount'], $data['products'])) {
            error_log("Invalid or incomplete order data: " . $rawData);
            $this->sendJsonResponse(false, 'Invalid or incomplete order data: Missing user_id, total_amount, or products', 400);
            return;
        }

        if (!is_numeric($data['user_id']) || $data['user_id'] <= 0) {
            $this->sendJsonResponse(false, 'Invalid user_id: Must be a positive integer', 400);
            return;
        }

        if (!is_numeric($data['total_amount']) || $data['total_amount'] <= 0) {
            $this->sendJsonResponse(false, 'Invalid total_amount: Must be a positive number', 400);
            return;
        }

        if (!is_array($data['products']) || empty($data['products'])) {
            $this->sendJsonResponse(false, 'Invalid products: Must be a non-empty array', 400);
            return;
        }

        try {
            $this->orderModel->beginTransaction();

            $orderData = [
                'user_id' => (int)$data['user_id'],
                'order_date' => date('Y-m-d H:i:s'),
                'total_amount' => (float)$data['total_amount']
            ];

            error_log("Inserting order: " . print_r($orderData, true));

            $sqlCheckUser = "SELECT id FROM users WHERE id = :user_id";
            $stmt = $this->orderModel->db->query($sqlCheckUser, [':user_id' => $orderData['user_id']]);
            if (!$stmt->fetch()) {
                throw new Exception("User ID {$orderData['user_id']} does not exist");
            }

            $orderID = $this->orderModel->insertOrder($orderData);
            if (!$orderID) {
                throw new Exception('Failed to create order');
            }

            foreach ($data['products'] as $product) {
                if (!isset($product['product_id'], $product['quantity'], $product['subtotal'])) {
                    throw new Exception('Invalid product data: Missing product_id, quantity, or subtotal');
                }

                if (!is_numeric($product['product_id']) || $product['product_id'] <= 0) {
                    throw new Exception('Invalid product_id: Must be a positive integer');
                }

                if (!is_numeric($product['quantity']) || $product['quantity'] <= 0) {
                    throw new Exception('Invalid quantity: Must be a positive integer');
                }

                if (!is_numeric($product['subtotal']) || $product['subtotal'] <= 0) {
                    throw new Exception('Invalid subtotal: Must be a positive number');
                }

                error_log("Inserting order details for product ID {$product['product_id']}: " . print_r($product, true));

                $result = $this->orderModel->insertOrderDetails(
                    $orderID,
                    (int)$product['product_id'],
                    (int)$product['quantity'],
                    (float)$product['subtotal']
                );

                if (!$result) {
                    throw new Exception('Failed to save order details');
                }

                error_log("Updating stock for product ID {$product['product_id']}, quantity: {$product['quantity']}");
                $stockUpdated = $this->orderModel->updateProductStock(
                    (int)$product['product_id'],
                    (int)$product['quantity']
                );

                if (!$stockUpdated) {
                    throw new Exception('Failed to update product stock');
                }
            }

            $this->orderModel->commit();
            $this->sendJsonResponse(true, 'Order placed successfully', 200, ['order_id' => $orderID]);

        } catch (Exception $e) {
            $this->orderModel->rollBack();
            error_log("Order processing error: " . $e->getMessage());
            $this->sendJsonResponse(false, 'Order processing failed: ' . $e->getMessage(), 500);
        }
    }

    private function sendJsonResponse($success, $message, $statusCode = 200, $data = []) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode(array_merge([
            'success' => $success,
            'message' => $message
        ], $data));
        exit;
    }
}