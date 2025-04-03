<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Stock Products</h2>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2 text-left">Stock ID</th>
                        <th class="border px-4 py-2 text-left">Stock Name</th>
                        <th class="border px-4 py-2 text-left">Product Name</th>
                        <th class="border px-4 py-2 text-left">Product ID</th>
                        <th class="border px-4 py-2 text-left">Quantity</th>
                        <th class="border px-4 py-2 text-left">Last Updated</th>
                        <th class="border px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($stock) && is_array($stock)) : ?>
                        <tr class="border-t">
                            <td class="border px-4 py-2"><?= htmlspecialchars($stock['stock_id']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($stock['stock_name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($stock['product_name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($stock['product_id']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($stock['quantity']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($stock['last_updated']) ?></td>
                            <td class="flex py-3 px-6 font-semibold justify-center relative">
                                        <a href="/products/edit?id=<?= $product['id'] ?>"
                                           class="block px-2 py-2 text-gray-700 flex items-center">
                                            <i class="far fa-edit mr-1" style="color: green;"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="openModal('deleteProductModal<?= $product['id'] ?>')"
                                                class="block text-left px-2 py-2 text-gray-700 flex items-center">
                                            <i class="fas fa-trash-alt mr-1" style="color: red"></i>
                                        </a>
                                        <a href="/pages/details?id=<?php echo htmlspecialchars($product['id']); ?>"
                                        class="block px-2 py-2 text-gray-700 flex items-center">
                                            <i class="far fa-eye mr-1" style="color: blue;"></i>
                                        </a>
                                    </td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center text-red-500 font-semibold py-4">Stock not found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
