 <div class="bg-gray-200 p-6">
    <h1 class="text-2xl font-bold mb-6">Products in Stock</h1>

    <div class="grid grid-cols-3 gap-4">
         <?php if (!empty($stocks)) : ?>
             <?php foreach ($stocks as $stock) : ?>
                <div class="bg-white rounded-lg shadow-lg p-4 text-center">
                    <h2 class="text-lg font-semibold"><?php echo $stock['product_name']; ?></h2>
                    <p class="text-md font-bold mt-1">Quantity: <?php echo $stock['quantity']; ?></p>
                    <a href="/pages/detail?id=<?php echo urlencode($stock['id']); ?>"
                        class="mt-2 inline-block bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 transition">
                        View Details
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-red-500">No products available.</p>
        <?php endif; ?>
    </div>
 </div>