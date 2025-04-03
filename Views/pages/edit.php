<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h4 class="text-xl font-bold mb-4 font-semibold">Edit Product</h4>
                <form id="editProductForm" action="/pages/update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label for="product_name" class="font-semibold mb-1">Product Name</label>
                            <input type="text" name="name" id="product_name" value="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>" required class="border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm mt-1 hidden" id="product_name_error">Please enter a product name</span>
                        </div>
                        
                        <div class="flex flex-col">
                            <label for="price" class="font-semibold mb-1">Price</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" value="<?php echo $product['price']; ?>" required class="border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm mt-1 hidden" id="price_error">Please enter a valid price</span>
                        </div>
                        
                        <div class="flex flex-col">
                            <label for="date-start" class="font-semibold mb-1">Date</label>
                            <input type="date" name="date-start" id="date-start" value="<?php echo date('Y-m-d', strtotime($product['date'])); ?>" required class="border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                        </div>
                        
                        <div class="flex flex-col">
                            <label for="type" class="font-semibold mb-1">Category</label>
                            <select name="type" id="type" required class="border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                <option value="">Choose Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['category_id']; ?>" <?php echo ($product['category_id'] == $category['category_id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="flex flex-col">
                            <label for="product_content" class="font-semibold mb-1">Product Content</label>
                            <textarea name="product_content" id="product_content" rows="8" class="border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-300 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker"><?php echo isset($product['description']) ? htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
                        </div>
                        
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1">Product Image</label>
                            <div class="border border-gray-300 rounded-lg p-4 flex flex-col items-center justify-centerbg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(this)" class="mb-2 w-full border border-gray-300  dark:text-light dark:border-primary-darker">
                                <div class="w-24 h-24 flex items-center justify-center border border-gray-200 rounded-lg overflow-hidden mt-3">
                                    <img id="image-preview" src="<?php echo !empty($product['image']) ? '/Assets/images/uploads/' . $product['image'] : '#'; ?>" alt="Product Image Preview" class="object-cover w-full h-full <?php echo !empty($product['image']) ? '' : 'hidden'; ?>">
                                </div>
                                <p class="text-gray-500 text-sm mt-2">Drag and drop a file to upload</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-4 mt-6">
                        <button type="button" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:opacity-90" onclick="window.location.href='/products'">Cancel</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:opacity-90">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>