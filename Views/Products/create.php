<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h4 class="text-xl font-bold font-semibold mb-4">Add Product</h4>
                <form id="addProductForm" action="/products/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col">
                            <label for="product_name" class="font-semibold mb-1">Product Name</label>
                            <input type="text" name="name" id="product_name" required class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm hidden" id="product_name_error">Please enter a product name</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="price" class="font-semibold mb-1">Price</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" required class="border border-gray-300 rounded-lg font-semibold p-2 focus:ring-2 focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm hidden" id="price_error">Please enter a valid price</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="date-start" class="font-semibold mb-1">Date</label>
                            <input type="date" name="date-start" id="date-start" required class="border border-gray-300 rounded-lg p-2 focus:ring-2 font-semibold focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm hidden" id="date_error">Please select a valid date</span>
                        </div>
                        <div class="flex flex-col">
                            <label for="type" class="font-semibold mb-1">Category</label>
                            <select name="type" id="type" required class="border border-gray-300 rounded-lg p-2 font-semibold focus:ring-2 focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                <option value="">Choose Category</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo $category['category_id']; ?>">
                                        <?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-red-500 text-sm hidden" id="category_id_error">Please select a category</span>
                        </div>

                    </div>
                    <!-- Product Image Upload (Full width of the column) -->
                <div class="flex flex-col">
                    <label class="font-semibold mb-2 block">Product Image</label>
                    <div class="border border-gray-300 rounded-lg p-4 w-full flex flex-col items-center bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                        <input type="file" name="image" id="image" accept="image/*" class="mb-3 cursor-pointer w-full"
                                onchange="previewImage(this)">
                        <div class="border-dashed border-2 border-gray-300 mt-2 rounded-lg p-4 text-center cursor-pointer hover:border-blue-500 transition w-full bg-white dark:text-light dark:bg-darker dark:border-primary-darker"
                                id="drop-zone">
                            <div class="flex flex-col items-center">
                                <img id="image-preview" src="#" alt="Product Image Preview"
                                        class="w-24 h-24 object-cover rounded hidden">
                                <h4 class="font-semibold text-sm mt-2">Drag and drop a file to upload</h4>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="flex justify-end space-x-4">
                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg" onclick="window.location.href='/products'">Cancel</button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        // Image preview functionality
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const file = input.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // Form validation
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate product name
            const productName = document.getElementById('product_name');
            if (!productName.value.trim()) {
                document.getElementById('product_name_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('product_name_error').style.display = 'none';
            }
            
            // Validate date
            const date = document.getElementById('date-start');
            if (!date.value) {
                document.getElementById('date_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('date_error').style.display = 'none';
            }
            
            // Validate price
            const price = document.getElementById('price');
            if (!price.value || price.value < 0) {
                document.getElementById('price_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('price_error').style.display = 'none';
            }
            
            // Validate category
            const category = document.getElementById('type');
            if (!category.value) {
                document.getElementById('category_id_error').style.display = 'block';
                isValid = false;
            } else {
                document.getElementById('category_id_error').style.display = 'none';
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
 
    </script>
