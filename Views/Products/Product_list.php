<?php  
$db = new Database();  
$query = "SELECT * FROM products";   
$result = $db->query($query);  
$products = $result->fetchAll();  

$product_types = ['Nut' => 'Nut Products', 'Powder' => 'Powder Products'];   
?>  
<?php
$db = new Database();
$query = "SELECT * FROM products";
$result = $db->query($query);
$products = $result->fetchAll();
?>
<div class="mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">Products List</h2>
                <div class="overflow-x-auto bg-white shadow-lg rounded-lg mt-5">
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-blue-800 text-white uppercase text-xs sm:text-sm leading-normal">
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">ID</th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Image</th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Product Name</th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Price</th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                    <select id="product-filter" class="bg-blue-800 border border-blue-300 dark:border-gray-700 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary">
                                        <option value="">All Types</option>
                                        <?php foreach ($product_types as $key => $value): ?>  
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endforeach; ?>  
                                    </select>
                                </th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Date</th>
                                <th class="border border-gray-200 dark:border-gray-700 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body">
                            <?php if (count($products) > 0): ?>  
                                <?php foreach ($products as $row): ?>  
                                    <tr class="bg-gray-50 dark:bg-gray-900">
                                        <td class="border border-gray-200 dark:border-gray-700 px-4 py-2"><?= ($row['id']) ?></td>
                                        <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                            <img src="../../Assets/images/<?php echo $row['image'] ?>" alt="" width="50" height="50" class="rounded-md">
                                        </td>
                                        <td class="border border-gray-200 dark:border-gray-700 px-4 py-2"><?= ($row['product_name']) ?></td>
                                        <td class="border border-gray-200 dark:border-gray-700 px-4 py-2"><?= ($row['price']) ?>$</td>
                                        <td class="border border-gray-200 dark:border-gray-700 px-4 py-2"><span class="product-type"><?= ($row['type']) ?></span></td>
                                        <td class="border border-gray-200 dark:border-gray-700 px-4 py-2"><?= date("d/m/Y", strtotime($row['date'])) ?></td>
                                        <td class="border border-gray-200 dark:border-gray-700 px-4 py-2">
                                            <a href="/products/edit?id=<?= $row['id'] ?>">
                                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">Edit</button>
                                            </a>
                                            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete <?= addslashes($row['product_name']) ?>?');">
                                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-300 ml-2">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>  
                            <?php else: ?>  
                                <tr>
                                    <td colspan="7" class="text-center py-4">No products found</td>
                                </tr>
                            <?php endif; ?>  
                        </tbody>
                    </table>
                </div>
                <a href="/products/create" class="inline-block mt-4">
                    <button class="bg-blue-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg transition duration-300">Add Product</button>
                </a>
            </div>
        </div>
    </div>
</div>

    <script>  
        function filterByType(type) {  
            const rows = document.querySelectorAll("#product-table-body tr");  
            rows.forEach(row => {  
                const productType = row.querySelector(".product-type").innerText.trim();  
                row.style.display = (type === "" || productType === type) ? "" : "none"; 
            });  
        }  
    </script>  
