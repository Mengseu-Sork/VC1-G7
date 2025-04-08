<div class="bg-gray-200 p-6">
    <h1 class="text-2xl font-bold mb-6">Products in Stock</h1>
    <div class="flex justify-between flex-col md:flex-row items-center gap-4 mb-6">
        <a href="/pages/create">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                Add Product
            </button>
        </a>
        <div class="flex w-full md:w-auto gap-2 relative">
            <input type="text" id="searchInput" placeholder="Search products..." required
                class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 outline-none bg-white"
                oninput="searchProducts()" aria-label="Search products">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" aria-hidden="true"></i>
            <button type="button" onclick="searchProducts()"
                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300" aria-label="Search">
                Search
            </button>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4" id="productGrid">
        <?php if (!empty($stocks)) : ?>
            <?php foreach ($stocks as $stock) : ?>
                <div class="bg-white rounded-lg shadow-lg p-4 text-center product-item">
                    <h2 class="text-lg font-semibold">
                        <?php echo htmlspecialchars($stock['name'] ?? 'No Name'); ?>
                    </h2>
                    <p class="text-md font-bold mt-1">
                        Quantity: <?php echo intval($stock['quantity'] ?? 0); ?>
                    </p>
                    <a href="/pages/details?stock_id=<?php echo urlencode($stock['stock_id']); ?>" class="mt-3 inline-block">
                        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            View Details
                        </button>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-red-500 col-span-full text-center">No products available.</p>
        <?php endif; ?>
    </div>
</div>
<script>
function searchProducts() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toLowerCase();
    const productItems = document.querySelectorAll(".product-item");

    productItems.forEach((item) => {
        const nameElement = item.querySelector("h2");
        const productName = nameElement.textContent.toLowerCase();

        if (productName.includes(filter)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
}
</script>
