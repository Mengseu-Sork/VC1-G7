<!-- stock_detail.php -->
<div class="bg-gray-200 p-6">
    <h1 class="text-2xl font-bold mb-4">Stock Detail</h1>

    <?php if (isset($stock['error'])) : ?>
        <p class="text-red-500"><?php echo htmlspecialchars($stock['error']); ?></p>
    <?php elseif ($stock) : ?>
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="text-lg font-semibold">Product Name: <?php echo htmlspecialchars($stock['name']); ?></h2>
            <p>Product ID: <?php echo htmlspecialchars($stock['product_id']); ?></p>
            <p>Quantity: <?php echo htmlspecialchars($stock['quantity']); ?></p>
            <p>Last Updated: <?php echo htmlspecialchars($stock['last_updated']); ?></p>
            <p>Price: <?php echo htmlspecialchars($stock['price']); ?></p>
            <p>Description: <?php echo htmlspecialchars($stock['description']); ?></p>
            <p>Category: <?php echo htmlspecialchars($stock['category_name']); ?></p>
        </div>
    <?php else : ?>
        <p class="text-red-500">Stock details not found.</p>
    <?php endif; ?>
</div>