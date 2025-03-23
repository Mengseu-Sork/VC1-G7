<?php
$db = new Database();
$query = "SELECT * FROM product WHERE type = 'Nut'"; // Added WHERE clause to filter by type
$result = $db->query($query);
$products = $result->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Dashboard</title>
    <link rel="stylesheet" href="../Assets/css/product_list.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Management</h1>
            <div>
                <label class="toggle-switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
                <img src="https://via.placeholder.com/30" alt="User Avatar" style="border-radius: 50%;">
            </div>
        </div>

        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search products...">
            <button>Search</button>
        </div>

        <h2>List Products of nut</h2>
        <table class="product-list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th> 
                    <th>Product Name</th>
                    <th>Price</th> 
                    <th>Type</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $row): ?>
                        <tr>
                            <td><?= ($row['id']) ?></td>
                            <td>
                                <img src="../../Assets/images/<?php echo $row["image"]?>" alt=""  width="50" height="50" style="border-radius: 5px;"  >
                            </td>
                            
                            <td><?= ($row['product_name']) ?></td>
                            <td><?= ($row['price']) ?>$</td> 
                            <td><span class="product-type"><?= ($row['type']) ?></span></td>
                            <td><?= date("d/m/Y", strtotime($row['date'])) ?></td>
                            
                            <td>
                            <a href="/products/edit?id=<?= $row['id'] ?>">
                             <button class="edit-button">Edit</button>
                            </a>
                            <button onclick="openModal('deleteproductModal<?= $row['id'] ?>')"
                                    class="px-4 py-2 text-white bg-red-500 hover:bg-red-400 rounded-md transition duration-200">
                                    Delete
                                </button>
                                <div id="deleteproductModal<?= $row['id'] ?>"
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                        <h2 class="text-lg font-semibold">Delete product</h2>
                                        <p class="mt-4">Are you sure you want to delete this product?</p>

                                        <div class="mt-6 flex justify-end space-x-2">
                                            <!-- Cancel Button -->
                                            <button onclick="closeModal('deleteproductModal<?= $row['id'] ?>')"
                                                class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 transition duration-200">
                                                Cancel
                                            </button>

                                            <!-- Confirm Delete -->
                                            <form action="/products/delete?id=<?= $row['id'] ?>" method="POST">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">No products found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="/products/create">
            <button class="add-product-button">Add Product</button>
        </a>
    </div>

    <script>
        // JavaScript to filter products by name
        document.getElementById('search-input').addEventListener('input', function() {
            var searchQuery = this.value.toLowerCase();
            var rows = document.querySelectorAll('.product-row');
            
            rows.forEach(function(row) {
                var productName = row.cells[2].textContent.toLowerCase(); // Assuming product name is in the 3rd column (index 2)
                
                if (productName.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>