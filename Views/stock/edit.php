
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-xl font-bold font-semibold mb-4">Edit Stock</h2>

                <form action="/stock/update" method="POST" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="hidden" name="stock_id" value="<?= $stock['stock_id'] ?>">

                        <!-- Select Product (readonly disabled) -->
                        <div class="flex flex-col">
                            <label class="font-semibold mb-1">Product</label>
                            <div class="border border-gray-300 rounded-lg p-2 focus:ring-2 font-semibold focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                <?= htmlspecialchars($stock['product_name']) ?>
                            </div>
                            <input type="hidden" name="product_id" value="<?= $stock['product_id'] ?>">
                        </div>

                        <!-- Date -->
                        <div class="flex flex-col">
                            <label for="date-start" class="font-semibold mb-1">Last Updated</label>
                            <input type="datetime-local" 
                                name="last_updated" 
                                id="date-start" 
                                value="<?= date('Y-m-d\TH:i', strtotime($stock['last_updated'])) ?>" 
                                required 
                                class="border border-gray-300 rounded-lg p-2 focus:ring-2 font-semibold focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm hidden" id="date_error">Please select a valid date</span>
                        </div>


                        <!-- Quantity -->
                        <div class="flex flex-col">
                            <label for="product_content" class="font-semibold mb-2 block">Quantity</label>
                            <input type="number" 
                                name="quantity" 
                                id="product_content" 
                                value="<?= htmlspecialchars($stock['quantity']) ?>" 
                                required 
                                class="border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                            <span class="text-red-500 text-sm hidden" id="product_content_error">Please enter a valid quantity</span>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 pt-6">
                        <button type="button" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg" onclick="window.location.href='/stock'">
                            Cancel
                        </button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

