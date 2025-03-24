<?php

$productModel = new ProductModel();
$products = $productModel->getAllProducts();
$categories_name = [
    'Nut' => 'Nut Products',
    'Powder' => 'Powder Products',
    'Drinks' => 'Drinks Products'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json"); 

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "../../Assets/images/uploads/";
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
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 mb-16 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h1 class="text-left ml-4 text-3xl font-bold mb-2">Products</h1>
                <div class="flex flex-wrap gap-8 p-4 justify-between">
                    <div class="flex w-full md:w-auto gap-2 relative">
                    <input type="text" id="searchInput" placeholder="Search products..." required
                            class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 outline-none"
                            oninput="searchProducts()">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <button type="button" onclick="searchProducts()"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                            Search
                    </button>
                </div>
                    <select class="pr-5 pl-2 border border-gray-300 rounded-md transition duration-300 mr-1 bg-white dark:bg-darker border-b dark:border-primary-darker" onchange="filterByCategory(this.value)">
                        <option value="#">All Products</option>
                        <?php foreach ($categories_name as $key => $value): ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>  
                    </select>
                </div>
                <div class="container flex flex-wrap gap-9 p-4" id="productContainer">
                    <?php foreach ($products as $product): ?>
                        <div class="w-48 h-76 bg-white border border-gray-300 p-4 rounded-lg shadow-md transition duration-300 flex flex-col items-center bg-white dark:bg-darker border-b dark:border-primary-darker"
                            data-name="<?= htmlspecialchars($product['name']) ?>"
                            data-price="<?= htmlspecialchars($product['price']) ?>">
                            <img src="../Assets/images/uploads/<?php echo $product["image"]; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-28 h-28 rounded-md mb-1 mt-1">
                            <h4 class="text-lg font-bold mt-2 mb-2"><?= htmlspecialchars($product['name']) ?></h4>
                            <p class="text-gl flex justify-center text-green-500 font-bold mb-2">In Stock</p>
                            <p class="text-gl font-semibold text-yellow-600"><?= htmlspecialchars($product['price']) ?></p>
                            <button class="mt-3 border px-8 py-2 bg-blue-500 relative dark:bg-darker border-b dark:border-primary-darker hover:bg-blue-600 text-white font-semibold rounded-md transition">
                                <i class="fas fa-shopping-cart mr-2" style="color: orange;"></i> ORDER
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script>  
    function filterByCategory(category) {
        const rows = document.querySelectorAll("#product-table-body tr");
        rows.forEach(row => {
            const productCategory = row.getAttribute("data-category");
            row.style.display = (category === "" || productCategory === category) ? "" : "none";
        });
    }
</script>