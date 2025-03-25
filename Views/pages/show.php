
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto ">
        <div class="container mx-auto p-8">  
            <?php if (isset($product) && $product): ?>
            <div class="flex flex-col md:flex-row bg-white shadow-lg rounded-lg bg-white dark:bg-darker border-b dark:border-primary-darker">  
                <div class="w-full md:w-1/2 p-6">  
                    <!-- Updated image path to match your application structure -->
                    <img src="../Assets/images/uploads/<?php echo $product["image"]; ?>" 
                        alt="<?php echo htmlspecialchars($product['name']); ?>" 
                        class="ml-3 w-96 h-96 rounded-md" alt="Product Image" />  
                </div>  
                <div class="w-full md:w-1/2 p-6">  
                    <h1 class="text-3xl font-bold font-semibold"><?php echo htmlspecialchars($product['name']); ?></h1>  
                    <div class="flex items-center mt-2">  
                        <span class="text-yellow-500 text-lg">&#9733;&#9733;&#9733;&#9733;&#9734;</span>  
                        <span class="ml-2 font-semibold">(4.7/721)</span> 
                        <span class="ml-4 bg-green-200 text-green-800 text-xs font-bold px-2 py-1 rounded-full">In Stock</span>  
                    </div>  
                    <div class="mt-4">  
                        <span class="text-xl font-bold text-red-500">$<?php echo number_format($product['price'], 2); ?></span>  
                    </div>  
                    <div class="mt-6">  
                        <h2 class="font-semibold">About This Item:</h2>  
                        <?php if (isset($category['description']) && !empty($category['description'])): ?>
                            <p class="font-semibold mt-3"><?php echo htmlspecialchars($category['description']); ?></p>
                        <?php else: ?>
                            <p class="font-semibold mt-2">No description available for this product.</p>
                        <?php endif; ?>
                        <ul class="mt-4 list-disc list-inside font-semibold">  
                            <li><strong>Available:</strong> In stock</li>  
                            <li><strong>Category:</strong> 
                                <?php if (isset($category) && $category): ?>
                                    <?php echo htmlspecialchars($category['name']); ?>
                                <?php else: ?>
                                    Not categorized
                                <?php endif; ?>
                            </li>  
                            <li><strong>Date Added:</strong> <?php echo date('F j, Y', strtotime($product['date'])); ?></li>
                            <li><strong>Shipping Area:</strong> All over the world</li>  
                            <li><strong>Shipping Fee:</strong> Free</li>  
                        </ul>  
                    </div>  
                    <div class="mt-6">  
                        
                    <a href="/products/prosuct_ratings?id=<?php echo $product['id']; ?>" class="ml-2 bg-green-200 text-gray-800 py-2 px-4 rounded hover:bg-green-100">Ratings</a>
                        <a href="/products" class="ml-2  bg-red-400  text-white py-2 px-4 rounded hover:bg-red-500">Back to Products</a>
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
    </div>
