<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                <div class="shadow-lg rounded-lg p-6 mb-16 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                    :style="{ backgroundColor: bgColor }">
                    <h1 class="text-2xl font-bold mb-6">Products in Stock</h1>
                    <div class="flex justify-between flex-col md:flex-row items-center gap-4 mb-6">
                        <a href="/stock/create">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                Add Product
                            </button>
                        </a>
                        <div class="flex w-full md:w-auto gap-2 relative">
                            <input type="text" id="searchInput" placeholder="Search stocks..." required
                                class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 outline-none bg-white dark:bg-darker border-b dark:border-primary-darker"
                                oninput="searchStock()" aria-label="Search stock">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
                            <button type="button" onclick="searchStock()"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300" aria-label="Search">
                                Search
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto bg-white shadow-lg rounded-lg mt-5">
                        <table id="productsTable" class="w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Product Name</th>
                                    <th class="py-3 px-6 text-center">Quantity</th>
                                    <th class="py-3 px-6 text-left">Date</th>
                                    <th class="py-3 px-6 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="product-table-body">
                                <?php foreach ($stocks as $stock): ?>
                                    <tr class="product-item product-row bg-white dark:bg-darker border-b dark:border-primary-darker transition duration-200">
                                        <td class="py-3 px-6 font-semibold">
                                            <?= htmlspecialchars($stock['product_name']) ?>
                                        </td>
                                        <td class="py-3 px-6 text-center font-semibold">
                                            <?= htmlspecialchars($stock['quantity']) ?>
                                        </td>
                                        <td class="py-3 px-6 font-semibold">
                                            <?= htmlspecialchars($stock['last_updated']) ?>
                                        </td>
                                        <td class="py-3 px-6 font-semibold text-center space-x-2">
                                            <a href="/stock/edit?id=<?= $stock['stock_id'] ?>" class="inline-block text-green-600 hover:text-green-800">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <button onclick="openModal('deleteStockModal<?= $stock['stock_id'] ?>')" class="inline-block text-red-600 hover:text-red-800">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        <!-- Delete Confirmation Modal -->
                                        <div id="deleteStockModal<?= $stock['stock_id'] ?>" 
                                            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                                <h2 class="text-lg font-semibold flex justify-center">Delete Stock</h2>
                                                <p class="mt-4">Are you sure you want to delete this stock?</p>

                                                <div class="mt-6 flex justify-end space-x-2">
                                                    <button onclick="closeModal('deleteStockModal<?= $stock['stock_id'] ?>')"
                                                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:opacity-90">
                                                        Cancel
                                                    </button>

                                                    <form action="/stock/delete?id=<?= $stock['stock_id'] ?>" method="POST">
                                                        <input type="hidden" name="id" value="<?= $stock['stock_id'] ?>">
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    function searchStock() {
        const input = document.getElementById("searchInput");
        const filter = input.value.toLowerCase();
        const productItems = document.querySelectorAll(".product-item");

        productItems.forEach((item) => {
            // Select the second <td> which contains product name
            const nameElement = item.querySelectorAll("td")[1];
            const productName = nameElement.textContent.toLowerCase();

            if (productName.includes(filter)) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    }
</script>
