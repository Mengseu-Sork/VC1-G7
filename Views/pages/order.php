<?php
// session_start();
// require_once __DIR__ . '/../../Databases/Database.php';

// $db = new Database("localhost", "root", "", "coffeeshop"); 
// $sql = "SELECT 
//     o.order_id AS id,
//     CONCAT(u.FirstName, ' ', u.LastName) AS user_name,
//     COALESCE(GROUP_CONCAT(DISTINCT p.product_name SEPARATOR ', '), 'No Product') AS product_name, 
//     COALESCE(SUM(od.subtotal), 0) AS price,  
//     o.order_date AS date
// FROM orders o
// LEFT JOIN users u ON o.users_id = u.id
// LEFT JOIN order_detail od ON o.order_id = od.order_id
// LEFT JOIN product p ON od.product_id = p.id
// GROUP BY o.order_id
// ORDER BY o.order_date DESC";

// $orders = $db->query($sql)->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Order List</h2>

        <!-- Success Message -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-200 text-green-800 p-3 rounded mb-3">
                <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <!-- Error Message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-200 text-red-800 p-3 rounded mb-3">
                <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Order Table -->
        <table class="w-full border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="p-3">User Name</th>
                    <th class="p-3">Product Name</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Date</th>
                    <th class="p-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= htmlspecialchars($order['user_name']); ?></td>
                            <td class="p-3"><?= htmlspecialchars($order['product_name']); ?></td>
                            <td class="p-3">$<?= number_format((float) $order['price'], 2); ?></td>
                            <td class="p-3"><?= htmlspecialchars($order['date']); ?></td>
                            <td class="p-3 text-center space-x-2">
                                <a href="/order/view?id=<?= urlencode($order['id']); ?>" class="text-blue-500 hover:underline">View</a>
                                <a href="/order/delete?id=<?= urlencode($order['id']); ?>" onclick="return confirm('Are you sure you want to delete this order?');" class="text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">No orders found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
