<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Inventory Manager</title>
    <link rel="stylesheet" href="/Assets/css/transaction.css">
</head>
<body>

    <h1>My Inventory Manager</h1>
    <div class="navbar">
        <div class="<?= basename($_SERVER['PHP_SELF']) == 'transaction_list.php' ? 'active' : '' ?>" onclick="window.location.href='transaction_list.php'">Incoming Purchases</div>
        <div class="<?= basename($_SERVER['PHP_SELF']) == 'outstock.php' ? 'active' : '' ?>" onclick="window.location.href='outstock.php'">Outgoing Orders</div>
        <div class="<?= basename($_SERVER['PHP_SELF']) == 'transaction-report.php' ? 'active' : '' ?>" onclick="window.location.href='transaction-report.php'">Reports</div>
    </div>
    <div class="container">
        <h2>Inventory Transactions Outgoing</h2>
        <table>
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Transaction Date</th>
                    <th>Transaction Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transactions)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No transactions found</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($transactions as $transaction): ?>
                        <tr>
                            <td><?= $transaction['transaction_id'] ?></td>
                            <td><?= $transaction['product_name'] ?? 'Unknown Product' ?></td>
                            <td><?= $transaction['quantity'] ?></td>
                            <td><?= date('m/d/Y', strtotime($transaction['transaction_date'])) ?></td>
                            <td><?= $transaction['transaction_type'] ?></td>
                            <td class="actions">
                                <a href="transaction.php?action=edit&id=<?= $transaction['transaction_id'] ?>">
                                    <button>Edit</button>
                                </a>
                                <form method="post" action="transaction.php?action=delete&id=<?= $transaction['transaction_id'] ?>" 
                                      style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="/Assets/js/transaction.js"></script>
</body>
</html>

