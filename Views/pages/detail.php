<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Stock Details</title>
</head>

<body>
    <div class="bg-gray-200 p-6">
        <h1 class="text-2xl font-bold mb-6">Stock Details</h1>
        <?php if (!empty($stock)) : ?>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Quantity</th>
                        <th class="py-3 px-6 text-left">Last Update</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="py-3 px-6">1</td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($stock['product_name']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($stock['quantity']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($stock['last_update']); ?></td>
                    </tr>
                </tbody>
            </table>
        <?php else : ?>
            <p class="text-red-500">Stock not found.</p>
        <?php endif; ?>
    </div>
</body>

</html>