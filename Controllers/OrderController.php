<?php
require_once __DIR__ . '/BaseController.php';

class OrderController extends BaseController {
    public function process() {
        // Move the POST handling logic here
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            header("Content-Type: application/json");
            $productName = $_POST['product_name'];
            $quantity = (int)$_POST['quantity'];
            $price = (float)$_POST['price'];
            $total = $quantity * $price;

            // Simulate order processing (replace with database logic)
            $success = true;

            if ($success) {
                echo json_encode([
                    "success" => true,
                    "message" => "Order placed successfully for $productName (Quantity: $quantity, Total: $$total)!"
                ]);
            } else {
                echo json_encode([
                    "success" => false,
                    "message" => "Failed to process the order."
                ]);
            }
            exit;
        }
    }
}