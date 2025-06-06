
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h4 class="text-xl font-bold mb-4 font-semibold">Edit Product</h4>
                <form id="editProductForm" action="/products/update" method="POST" enctype="multipart/form-data">
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
                        
                    </div>
                    <div class="flex flex-col mt-6">
                        <label class="font-semibold mb-1">Product Image</label>
                        <div class="border border-gray-300 rounded-lg p-4 flex flex-col items-center justify-centerbg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(this)" class="mb-2 w-full border border-gray-300  dark:text-light dark:border-primary-darker">
                            <div class="w-24 h-24 flex items-center justify-center border border-gray-200 rounded-lg overflow-hidden mt-3">
                                <img id="image-preview" src="<?php echo !empty($product['image']) ? '/Assets/images/uploads/' . $product['image'] : '#'; ?>" alt="Product Image Preview" class="object-cover w-full h-full <?php echo !empty($product['image']) ? '' : 'hidden'; ?>">
                            </div>
                            <p class="text-gray-500 text-sm mt-2">Drag and drop a file to upload</p>
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
                }
            }

            // Form validation
            document.getElementById('editProductForm').addEventListener('submit', function(event) {
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

            // Drag and drop functionality
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('image');

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('active');
            });

            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('active');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('active');
                
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    previewImage(fileInput);
                }
            });

            dropZone.addEventListener('click', () => {
                fileInput.click();
            });
        </script>


