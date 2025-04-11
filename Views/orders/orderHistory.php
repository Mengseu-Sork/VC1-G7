<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Order History</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen text-sm">
  <div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Order History</h1>

    <?php if (isset($_GET['message'])): ?>
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            <?= htmlspecialchars($_GET['message']) ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
      <div class="max-h-[450px] overflow-y-auto border border-gray-300 rounded-lg bg-white shadow-md">
        <table class="w-full border-collapse text-sm">
          <thead class="bg-blue-600 text-white sticky top-0 z-10">
            <tr>
              <th class="border px-4 py-3">Order ID</th>
              <th class="border px-4 py-3">User Name</th>
              <th class="border px-4 py-3">Order Date</th>
              <th class="border px-4 py-3">Total Amount</th>
              <th class="border px-4 py-3">Action</th>
            </tr>
          </thead>
          <tbody id="orderTableBody" class="text-center">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $index => $order): ?>
                    <tr class="hover:bg-gray-100 border-b">
                        <td class="border px-4 py-3"><?= htmlspecialchars($order['order_id']) ?></td>
                        <td class="border px-4 py-3"><?= htmlspecialchars($order['user_name']) ?></td>
                        <td class="border px-4 py-3"><?= htmlspecialchars($order['order_date']) ?></td>
                        <td class="border px-4 py-3 text-green-700 font-semibold">$<?= number_format($order['total_amount'], 2) ?></td>
                        <td class="border px-4 py-3">
                            <div class="flex justify-center space-x-4 text-base">
                                <a href="/order/view/<?= htmlspecialchars($order['order_id']) ?>" class="text-blue-600 hover:text-blue-800" title="View">
                                    <i class="far fa-eye"></i>
                                </a>
                                <a href="/order/delete/<?= htmlspecialchars($order['order_id']) ?>" class="text-red-600 hover:text-red-800" title="Delete"
                                   onclick="return confirm('Are you sure you want to delete this order?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="px-3 py-4 text-center text-gray-500">No orders found.</td>
                </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>