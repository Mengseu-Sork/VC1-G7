    <div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                <div class="shadow-lg rounded-lg p-6 mb-16 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                    :style="{ backgroundColor: bgColor }">
                    <h4 class="text-xl font-bold font-semibold mb-4">Add Product Instock</h4>
                    <form id="addProductForm" action="/stock/store" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col">
                                <label for="product_id" class="font-semibold mb-1">Select Product</label>
                                <select name="product_id" id="product_id" required class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                    <option value="">Choose a Product</option>
                                    <?php foreach ($products as $product): ?>
                                        <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-red-500 text-sm hidden" id="product_select_error">Please select a product</span>
                            </div>
                            <div class="flex flex-col">
                                <label for="date-start" class="font-semibold mb-1">Date</label>
                                <input type="date" name="last_updated" id="date-start" required class="border border-gray-300 rounded-lg p-2 focus:ring-2 font-semibold focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                <span class="text-red-500 text-sm hidden" id="date_error">Please select a valid date</span>
                            </div>
                            <div class="flex flex-col">
                                <label for="product_content" class="font-semibold mb-2 block">Quantity</label>
                                <input type="number" name="quantity" id="product_content" required class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                <span class="text-red-500 text-sm hidden" id="product_content_error">Please enter a valid quantity</span>
                            </div>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg" onclick="window.location.href='/stock/stock'">Cancel</button>
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>