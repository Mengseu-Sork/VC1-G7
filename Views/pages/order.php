<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Order History</h1>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                <th class="border p-3">Order ID</th>
                <th class="border p-3">User Name</th>
                <th class="border p-3">Order Date</th>
                <th class="border p-3">Total Amount</th>
                <th class="border p-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $index => $order): ?>
                    <tr class="text-center">
                        <td class="border p-3"><?= $index + 1 ?></td>
                        <td class="border p-3"><?= htmlspecialchars($order['user_name']) ?></td>
                        <td class="border p-3"><?= htmlspecialchars($order['order_date']) ?></td>
                        <td class="border p-3">$<?= number_format($order['total_amount'], 2) ?></td>
                        <td class="border p-3">
                            <div class="flex justify-center space-x-4">
                                <a href="/pages/viewOrder?id=<?= htmlspecialchars((string) $order['order_id']) ?>"
                                    class="text-blue-600 hover:text-blue-800" title="View Order Details">
                                    <i class="far fa-eye mr-1" style="color: blue;"></i>
                                </a>
                                <a href="/pages/deleteOrder.php?id=<?= htmlspecialchars((string) $order['order_id']) ?>"
                                    class="text-red-600 hover:text-red-800" title="Delete Order"
                                    onclick="return confirm('Are you sure you want to delete this order?');">
                                    <i class="fas fa-trash-alt mr-1" style="color: red;"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="border p-3 text-center text-gray-500">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>