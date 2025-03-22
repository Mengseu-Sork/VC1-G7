<?php
$categories_name = [
    'Nut' => 'Nut Products',
    'Powder' => 'Powder Products',
    'Drinks' => 'Drinks Products'
];
?>

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Management Dashboard</title>  
    <link rel="stylesheet" href="../Assets/css/product_list.css">  
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $targetDir = "Assets/images/uploads/";
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            // Allowed file types
            $allowedTypes = ["jpg", "jpeg", "png", "gif"];
            if (in_array($fileType, $allowedTypes)) {
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    echo json_encode(["success" => true, "message" => "File uploaded successfully!", "image" => $targetFilePath]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error uploading the file."]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "No file uploaded or an error occurred."]);
        }
        exit;
    }
    ?>
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
                    <th>Image</th>  
                    <th>Product Name</th>  
                    <th>Price</th>  
                    <th>Date</th>  

                    <th>
                        <select name="category-filter" id="category-filter" onchange="filterByCategory(this.value)">
                            <option value="">All Categories</option>
                            <?php foreach ($categories_name as $key => $value): ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>  
                        </select>
                    </th>  

                    <th>Actions</th>  
                </tr>  
            </thead>  
            <tbody id="product-table-body">  
                <?php foreach ($products as $product): ?>  
                    <tr data-category="<?= $product['category_name']; ?>">  
                    <td>  
                        <img src="../Assets/images/uploads/<?php echo $product["image"]?>" alt="" width="50" height="50" style="border-radius: 5px;">  
                    </td>  
                    <td><?php echo $product['name']; ?></td>  
                    <td><?php echo $product['price']; ?></td>  
                    <td><?php echo $product['date']; ?></td>  
                    <td><?php echo $product['category_name']; ?></td>  
                    

                    <td>  
                        <a href="/products/edit/<?php echo $product['id']; ?>" class="edit-button">Edit</a>  
                        <a href="/products/delete/<?php echo $product['id']; ?>" class="delete-button">Delete</a>  
                    </td>  
                </tr>  
                <?php endforeach; ?>  
            </tbody>  
        </table>  

        <a href="/products/create">  
            <button class="add-product-button">Add Product</button>  
        </a>  
    </div>  

    <script>  
        // Filter products by category
        function filterByCategory(category) {
            const rows = document.querySelectorAll("#product-table-body tr");
            rows.forEach(row => {
                const productCategory = row.getAttribute("data-category");
                row.style.display = (category === "" || productCategory === category) ? "" : "none";
            });
        }
    </script>  
</body>  
</html>
