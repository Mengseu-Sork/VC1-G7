<?php require_once("../layout/header.php"); ?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Orders</h1>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-3">Order ID</th>
                <th class="border p-3">Customer</th>
                <th class="border p-3">Product</th>
                <th class="border p-3">Quantity</th>
                <th class="border p-3">Total Price</th>
                <th class="border p-3">Status</th>
                <th class="border p-3">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr class="text-center">
                        <td class="border p-3"><?= htmlspecialchars($order['id']) ?></td>
                        <td class="border p-3"><?= htmlspecialchars($order['user_name']) ?></td>
                        <td class="border p-3"><?= htmlspecialchars($order['product_name']) ?></td>
                        <td class="border p-3"><?= htmlspecialchars($order['quantity']) ?></td>
                        <td class="border p-3 text-yellow-600">$<?= number_format($order['total_price'], 2) ?></td>
                        <td class="border p-3 <?= $order['order_status'] === 'pending' ? 'text-red-500' : 'text-green-600' ?>">
                            <?= htmlspecialchars($order['order_status']) ?>
                        </td>
                        <td class="border p-3"><?= htmlspecialchars($order['order_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="border p-3 text-center text-gray-500">No orders found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once("../layout/footer.php"); ?>
