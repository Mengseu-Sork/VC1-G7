<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
    <title>Product Details</title>  
</head>  
<body class="bg-gray-100">  
    <div class="container mx-auto p-8">  
        <?php if (isset($product) && $product): ?>
        <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg">  
            <div class="w-full md:w-1/2 p-6">  
                <img src="/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-auto rounded-lg">  
            </div>  
            <div class="w-full md:w-1/2 p-6">  
                <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($product['name']) ?></h1>  
                <div class="flex items-center mt-2">  
                    <span class="text-yellow-500 text-lg">&#9733;&#9733;&#9733;&#9733;&#9734;</span>  
                    <span class="ml-2 text-gray-600">(4.7/721)</span> 
                    <span class="ml-4 bg-green-200 text-green-800 text-xs font-bold px-2 py-1 rounded-full">In Stock</span>  
                </div>  
                <div class="mt-4">  
                    <span class="text-xl font-bold text-red-500">$<?= number_format($product['price'], 2) ?></span>  
                </div>  
                <div class="mt-6">  
                    <h2 class="font-semibold">About This Item:</h2>  
                    <?php if (isset($product['description']) && !empty($product['description'])): ?>
                        <p class="text-gray-700 mt-2"><?= htmlspecialchars($product['description']) ?></p>
                    <?php else: ?>
                        <p class="text-gray-700 mt-2">No description available for this product.</p>
                    <?php endif; ?>
                    <ul class="mt-4 list-disc list-inside text-gray-700">  
                        <li><strong>Available:</strong> In stock</li>  
                        <li><strong>Category:</strong> 
                            <?php if (isset($category) && $category): ?>
                                <?= htmlspecialchars($category['name']) ?>
                            <?php else: ?>
                                Not categorized
                            <?php endif; ?>
                        </li>  
                        <li><strong>Date Added:</strong> <?= date('F j, Y', strtotime($product['date'])) ?></li>
                        <li><strong>Shipping Area:</strong> All over the world</li>  
                        <li><strong>Shipping Fee:</strong> Free</li>  
                    </ul>  
                </div>  
                <div class="mt-6">  
                    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400">Add to Cart</button>  
                    <button class="ml-2 bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-200">Compare</button>  
                    <a href="/products" class="ml-2 inline-block bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-400">Back to Products</a>
                </div>  
            </div>  
        </div>
        <?php else: ?>
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold text-red-500">Product Not Found</h1>
            <p class="mt-4">Sorry, the product you are looking for does not exist or has been removed.</p>
            <div class="mt-6">
                <a href="/products" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-400">Back to Products</a>
            </div>
        </div>
        <?php endif; ?>
    </div>  
</body>  
</html>