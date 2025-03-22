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
        header("Content-Type: application/json"); // Set response type to JSON
    
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $targetDir = "Assets/images/uploads/";
            $fileName = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
            // Allowed file types
            $allowedTypes = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($fileType, $allowedTypes)) {
                echo json_encode(["success" => false, "message" => "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed."]);
                exit;
            }
    
            // Ensure target directory exists
            if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
                echo json_encode(["success" => false, "message" => "Failed to create upload directory."]);
                exit;
            }
    
            // Move the uploaded file
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                echo json_encode(["success" => true, "message" => "File uploaded successfully!", "image" => $targetFilePath]);
            } else {
                echo json_encode(["success" => false, "message" => "Error moving the uploaded file."]);
            }
        } else {
            // Handle specific upload errors
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE   => "The uploaded file exceeds the server limit.",
                UPLOAD_ERR_FORM_SIZE  => "The uploaded file exceeds the form limit.",
                UPLOAD_ERR_PARTIAL    => "The file was only partially uploaded.",
                UPLOAD_ERR_NO_FILE    => "No file was uploaded.",
                UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
                UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
                UPLOAD_ERR_EXTENSION  => "File upload stopped by a PHP extension."
            ];
            
            $errorCode = $_FILES["image"]["error"];
            $errorMessage = $errorMessages[$errorCode] ?? "An unknown error occurred.";
    
            echo json_encode(["success" => false, "message" => $errorMessage]);
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
