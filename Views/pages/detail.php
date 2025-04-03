<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Inventory</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Stock Products</h2>
    <table>
        <thead>
            <tr>
                <th>Stock ID</th>
                <th>Stock Name</th>
                <th>Product Name</th>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Last Updated</th>
            </tr>
        </thead>
        <tbody>

            <?php if (!empty($stock) && is_array($stock)) : ?>
                <tr>
                    <td><?= htmlspecialchars($stock['stock_id']) ?></td>
                    <td><?= htmlspecialchars($stock['stock_name']) ?></td>
                    <td><?= htmlspecialchars($stock['product_name'])  ?></td>
                    <td><?= htmlspecialchars($stock['product_id']) ?></td>
                    <td><?= htmlspecialchars($stock['quantity']) ?></td>
                    <td><?= htmlspecialchars($stock['last_updated']) ?></td>
                </tr>
            <?php else : ?>
                <p class="text-red-500">Stock not found.</p>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>