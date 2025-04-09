<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Order Details for Order Product</h1>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                <th class="border p-3">Order Detail ID</th>
                <th class="border p-3">Order ID</th>
                <th class="border p-3">Product ID</th>
                <th class="border p-3">Quantity</th>
                <th class="border p-3">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($order_details)): ?>
                <?php foreach ($order_details as $detail): ?>
                    <tr class="text-center">
                        <td class="border p-3"><?= htmlspecialchars((string) $detail['order_detail_id']) ?></td>
                        <td class="border p-3"><?= htmlspecialchars((string) $detail['order_id']) ?></td>
                        <td class="border p-3"><?= htmlspecialchars($detail['product_id']) ?></td>
                        <td class="border p-3"><?= htmlspecialchars((string) $detail['quantity']) ?></td>
                        <td class="border p-3">$<?= number_format((float) $detail['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="border p-3 text-center text-gray-500">No order details found for this order.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>