<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Order History</h2>

        <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="p-3">Order ID</th>
                    <th class="p-3">User Name</th>
                    <th class="p-3">Product Name</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php if (isset($orders) && !empty($orders)): ?>
                    <?php foreach ($orders as $index => $order): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= htmlspecialchars($order['id']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($order['user_name']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($order['product_name']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($order['price']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($order['date']) ?></td>

                            <td class="p-3 flex space-x-2">
                                <a href="/orders/view?id=<?= urlencode($order['id']) ?>"
                                    class="text-blue-500 hover:underline">View</a>
                                <form action="/orders/delete" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($order['id']) ?>">
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">No orders found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>