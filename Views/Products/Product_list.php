<?php


// Create a new instance of the Database class
$db = new Database();

// Write the query to select all products from the products table
$query = "SELECT * FROM product"; // Make sure the table name is correct

// Run the query and store the result
$result = $db->query($query);

// Fetch all products from the database
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
            <input type="text" placeholder="Search products...">
            <button>Search</button>
        </div>

        <h2>List Products</h2>
        <table class="product-list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td><span class="product-type"><?= htmlspecialchars($row['type']) ?></span></td>
                            <td><?= date("d/m/Y", strtotime($row['date'])) ?></td>
                            <td>
                                <a href="/Views/Products/edite.php">     
                                    <button class="edit-button">Edit</button>
                                </a>
                                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?');">
                                    <button class="delete-button">Delete</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No products found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="/Views/Products/create.php">
            <button class="add-product-button">Add Product</button>
        </a>
    </div>
</body>
</html>
