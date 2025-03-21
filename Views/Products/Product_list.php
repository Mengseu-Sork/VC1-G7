<?php  
$db = new Database();  
$query = "SELECT * FROM product";   
$result = $db->query($query);  
$products = $result->fetchAll();  

$product_types = ['Nut' => 'Nut Products', 'Powder' => 'Powder Products'];   
?>  
<?php
$db = new Database();
$query = "SELECT * FROM product";
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
            <input type="text" placeholder="Search products...">  
            <button>Search</button>  
        </div>  

        <h2>Products List</h2>  

        <table class="product-list">  
            <thead>  
                <tr>  
                    <th>ID</th>  
                    <th>Image</th>   
                    <th>Product Name</th>  
                    <th>Price</th>   
                    <th>
                        <select id="product-filter" onchange="filterByType(this.value)">
                            <option value="">All Types</option>
                            <?php foreach ($product_types as $key => $value): ?>  
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>  
                        </select>
                    </th>  
                    <th>Date</th>  
                    <th>Action</th>  
                </tr>  
            </thead>  
            <tbody id="product-table-body">  
                <?php if (count($products) > 0): ?>  
                    <?php foreach ($products as $row): ?>  
                        <tr>  
                            <td><?= ($row['id']) ?></td>  
                            <td>  
                                <img src="../../Assets/images/<?php echo $row["image"]?>" alt="" width="50" height="50" style="border-radius: 5px;">  
                            </td>  
                            <td><?= ($row['product_name']) ?></td>  
                            <td><?= ($row['price']) ?>$</td>   
                            <td><span class="product-type"><?= ($row['type']) ?></span></td>  
                            <td><?= date("d/m/Y", strtotime($row['date'])) ?></td>  
                            <td>  
                                <a href="/products/edit?id=<?= $row['id'] ?>">  
                                    <button class="edit-button">Edit</button>  
                                </a>  
                                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete <?= addslashes($row['product_name']) ?>?');">  
                                    <button class="delete-button">Delete</button>  
                                </a>  
                            </td>  
                        </tr>  
                    <?php endforeach; ?>  
                <?php else: ?>  
                    <tr>  
                        <td colspan="7" style="text-align: center;">No products found</td>  
                    </tr>  
                <?php endif; ?>  
            </tbody>  
        </table>  

        <a href="/products/create">  
            <button class="add-product-button">Add Product</button>  
        </a>  
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
</body>  
</html>
