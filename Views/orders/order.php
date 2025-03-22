<?php
session_start();

// Sample cart data (In real case, fetch from database or session)
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$shipping = isset($_SESSION['shipping']) ? $_SESSION['shipping'] : [];

// Calculate total price
$totalPrice = 0;
foreach ($cart as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Order Summary</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Review Your Order</h1>
    
    <h2>Order Summary</h2>
    <table border="1">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php foreach ($cart as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['name']); ?></td>
            <td><?= $item['quantity']; ?></td>
            <td>$<?= number_format($item['price'], 2); ?></td>
            <td>$<?= number_format($item['price'] * $item['quantity'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>Shipping Information</h2>
    <p>Name: <?= htmlspecialchars($shipping['name'] ?? 'Not provided'); ?></p>
    <p>Address: <?= htmlspecialchars($shipping['address'] ?? 'Not provided'); ?></p>
    <p>Phone: <?= htmlspecialchars($shipping['phone'] ?? 'Not provided'); ?></p>
    
    <h3>Total Price: $<?= number_format($totalPrice, 2); ?></h3>
    
    <a href="cart.php">Edit Cart</a>
    <a href="shipping.php">Edit Shipping</a>
    <a href="checkout.php"><button>Proceed to Checkout</button></a>
</body>
</html>
