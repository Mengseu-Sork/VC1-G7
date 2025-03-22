<?php  
$db = new Database();  
$query = "SELECT * FROM product";   
$result = $db->query($query);  
$products = $result->fetchAll();  

$product_types = ['Nut' => 'Nut Products', 'Powder' => 'Powder Products'];   
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
                                <a href="/products/edit">  
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
