<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg mb-16 p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h1 class="text-2xl font-semibold mb-6">List of Order History</h1>
                <div class="flex w-full md:w-auto gap-2 mb-6 relative">
                    <input type="text" id="searchInput" placeholder="Search products..." required
                        class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 outline-none bg-white dark:bg-darker border-b dark:border-primary-darker"
                        oninput="searchProducts()">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <button type="button" onclick="searchProducts()"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                        Search
                    </button>
                </div>
                <div class="overflow-x-auto bg-white shadow-lg rounded-lg mt-5">
                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Order no.</th>
                            <th class="py-3 px-6 text-left">Order date</th>
                            <th class="py-3 px-6 text-left">Bill-to name</th>
                            <th class="py-3 px-6 text-left">Total</th>
                            <th class="py-3 px-6 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                        <?php if (isset($orders) && !empty($orders)): ?>
                            <?php foreach ($orders as $index => $order): ?>
                            <tr class="duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                <td class="px-6 py-4 whitespace-nowrap">SO-<?= str_pad($index + 1 , 6, '0', STR_PAD_LEFT) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <?= date('m/d/Y', strtotime($order['order_date'])) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <?= htmlspecialchars($order['FirstName'] . ' ' . $order['LastName']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                $<?= number_format($order['total_amount'], 2) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                <a href="/pages/order_summary?id=<?= $order['order_id'] ?>" class="text-blue-600 hover:underline">
                                    <i class="fas fa-chevron-right mr-1"></i>View details
                                </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                            <td colspan="5" class="text-center px-6 py-6 text-gray-500">
                                You haven't placed any orders yet.
                            </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function searchProducts() {
    const input = document.getElementById("searchInput").value.toLowerCase().trim();
    const rows = document.querySelectorAll("tbody tr");

    rows.forEach(row => {
        const orderDate = row.cells[1]?.textContent.toLowerCase() || "";
        const billToName = row.cells[2]?.textContent.toLowerCase() || "";
        const totalAmount = row.cells[3]?.textContent.toLowerCase() || "";

        const isMatch = orderDate.includes(input) || billToName.includes(input) || totalAmount.includes(input);

        if (isMatch) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>
