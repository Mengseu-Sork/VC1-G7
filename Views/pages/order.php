<?php
// views/pages/order.php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Orders</h1>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
            </div>
        <?php endif; ?>

        <?php if (empty($orders)): ?>
            <p class="text-gray-600">You have no orders yet.</p>
        <?php else: ?>
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-3 text-left">Username</th>
                        <th class="p-3 text-left">Price</th>
                        <th class="p-3 text-left">Order Date</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?php echo htmlspecialchars($order['user_name']); ?></td>
                            <td class="p-3">$<?php echo number_format((float)$order['price'], 2); ?></td>
                            <td class="p-3"><?php echo htmlspecialchars($order['date']); ?></td>
                            <td class="p-3 flex space-x-2">
                                <a href="/order/view?id=<?php echo urlencode($order['id']); ?>" class="text-blue-500 hover:underline">View</a>
                                <a href="/order/delete?id=<?php echo urlencode($order['id']); ?>" onclick="return confirm('Are you sure?');" class="text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
