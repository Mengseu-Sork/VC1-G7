
    <title>Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            color: #777;
            font-weight: normal;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        td {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        tr:last-child td {
            border-bottom: 1px solid #ddd;
        }
        .view-details {
            color: #4a90e2;
            text-decoration: none;
        }
        .view-details:hover {
            text-decoration: underline;
        }
        .view-details:before {
            content: '› ';
        }
        .no-orders {
            text-align: center;
            padding: 30px 0;
            color: #777;
        }
    </style>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reviews</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-4 py-8 max-w-6xl">
    
    <h1>Your Order History</h1>
    
    <table>
        <thead>
            <tr>
                <th>Order no.</th>
                <th>Order date</th>
                <th>Bill-to name</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($orders) && !empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>SO-<?= str_pad($order['order_id'], 6, '0', STR_PAD_LEFT) ?></td>
                        <td>
                            <?php 
                                // Format the date from timestamp to a readable format
                                echo date('m/d/Y', strtotime($order['order_date']));
                            ?>
                        </td>
                        <td><?= $order['FirstName'] . ' ' . $order['LastName'] ?></td>
                        <td>$<?= number_format($order['total_amount'], 2) ?></td>
                        <td><a href="/pages/order_summary?id=<?= $order['order_id'] ?>" class="view-details">View details</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="no-orders">You haven't placed any orders yet.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
