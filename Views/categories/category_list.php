<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                 <h2 class="text-left ml-1 text-2xl font-bold mb-6">Category List</h2>
                <div class="flex justify-between flex-col md:flex-row items-center gap-4 mb-6">
                    <a href="/categories/create">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">Add Category</button>
                    </a>
                    <div class="flex w-full md:w-auto gap-2 relative">
                            <input type="text" id="searchInput" placeholder="Search products..." required
                                class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 outline-none bg-white dark:bg-darker border-b dark:border-primary-darker"
                                oninput="searchProducts()">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="searchProducts()"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                Search
                            </button>
                    </div>
                </div>
                <table class="min-w-full bg-white shadow-md rounded-lg border-collapse">
                    <thead>
                        <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Description</th>
                            <th class="px-6 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $index => $category): ?>
                                <tr class="duration-200 rounded-lg shadow-md transition bg-white border-b dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                    <td class="px-6 py-4"><?= $index + 1 ?></td>
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($category['name']); ?></td>
                                    <td class="px-6 py-4"><?php echo htmlspecialchars($category['description']); ?></td>
                                    <td class="flex py-3 px-6 font-semibold justify-center relative">
                                        <a href="/categories/edit?id=<?= htmlspecialchars($category['category_id']) ?>"
                                        class="block px-2 py-2 text-gray-700 flex items-center">
                                            <i class="far fa-edit mr-1" style="color: green;"></i>
                                        </a>
                                        <button onclick="openModal('deleteCategoriesModal<?= $category['category_id'] ?>')" 
                                                class="block text-left px-2 py-2 text-gray-700 flex items-center">
                                                <i class="fas fa-trash-alt mr-1" style="color: red"></i>
                                        </button>

                                    </td>
                                    <div id="deleteCategoriesModal<?= $category['category_id'] ?>"
                                         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                            <h2 class="text-lg font-semibold flex justify-center">Delete Category</h2>
                                            <p class="mt-4">Are you sure you want to delete this Category?</p>

                                            <div class="mt-6 flex justify-end space-x-2">
                                                <button onclick="closeModal('deleteCategoriesModal<?= $category['category_id'] ?>')"
                                                        class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:opacity-90">
                                                    Cancel
                                                </button>

                                                <a href="/categories/delete?id=<?= $category['category_id'] ?>" 
                                                   class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200 inline-block text-center">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let table = document.querySelector("table");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName("td");

        if (cells.length > 0) {
            let id = cells[0].innerText.toLowerCase().trim();
            let name = cells[1].innerText.toLowerCase().trim();

            if (id.includes(input) || name.includes(input)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    if (input === "") {
        for (let i = 1; i < rows.length; i++) {
            rows[i].style.display = "";
        }
    }
}
    // Open modal for deletion
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    // Close modal for deletion
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

</script>