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

<!-- Styles -->  
<style>  
    .product-image-container {  
        position: relative;  
        width: 100%;  
        height: 100%;  
    }  
    .view-more-overlay {  
        position: absolute;  
        top: 0;  
        left: 0;  
        width: 100%;  
        height: 100%;  
        background: rgba(255, 209, 129, 0.58);  
        color: white;  
        display: flex;  
        align-items: center;  
        justify-content: center;  
        opacity: 0;  
        transition: opacity 0.3s ease;  
        border-radius: 5px;  
        pointer-events: none;  
    }  
    .product-image-container:hover .view-more-overlay {  
        opacity: 1;  
    }  
</style>  

<!-- HTML Structure -->  
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">  
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">  
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">  
            <div class="shadow-lg rounded-lg p-6 mb-16 border-2 border-gray-200 dark:border-primary-darker transition duration-300"  
                 :style="{ backgroundColor: bgColor }">  
                <h1 class="text-left ml-4 text-3xl font-bold">Products</h1> 
                <div class="flex flex-wrap gap-8 p-4 justify-between">  
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
                    <select id="category-filter"  
                        class="pr-5 pl-2 border border-gray-300 rounded-md transition duration-300 mr-1 bg-white dark:bg-darker border-b dark:border-primary-darker"  
                        onchange="filterByCategory(this.value)">  
                        <option value="">All Products</option>  
                        <?php foreach ($categories_name as $key => $value): ?>  
                            <option value="<?= $key ?>"><?= $value ?></option>  
                        <?php endforeach; ?>  
                    </select>
                </div>
                <div class="container flex flex-wrap gap-8 p-4" id="productContainer">  
                    <?php foreach ($products as $product): ?>  
                        <div class="w-48 h-76 border border-gray-300 p-4 rounded-lg shadow-md transition duration-300 flex flex-col items-center border-2 border-gray-200 dark:border-primary-darker"  
                        data-category="<?= htmlspecialchars($product['category_name']); ?>"
                        data-name="<?= htmlspecialchars($product['name']) ?>"
                        data-price="<?= htmlspecialchars($product['price']) ?>"> 
                            <div class="product-image-container flex justify-center">  
                                <a href="/pages/details?id=<?php echo htmlspecialchars($product['id']); ?>">  
                                    <img src="../Assets/images/uploads/<?php echo htmlspecialchars($product["image"]); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-28 h-28 rounded-md mb-1 mt-1">  
                                    <div class="view-more-overlay">View More</div>  
                                </a>  
                            </div>  
                            <h4 class="text-lg font-bold mt-2"><?= htmlspecialchars($product['name']) ?> </h4>  
                            <span class="category hidden"><?= htmlspecialchars($product['category']) ?></span>  
                            <p class="text-gl text-green-600 font-semibold mt-2 mb-2"> In Stock </p>  
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
        const productCards = document.querySelectorAll("#productContainer div[data-category]");  

        productCards.forEach(card => {  
            const productCategory = card.getAttribute("data-category").toLowerCase();  
 
            if (!category || productCategory === category.toLowerCase()) {  
                card.style.display = "";  
            } else {  
                card.style.display = "none";  
            }  
        });  
    }  

    function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let productContainer = document.getElementById("productContainer");
    let products = productContainer.getElementsByClassName("w-48");

    console.log("Search Input: ", input);

    // Loop through all products to see if they match the search input
    for (let product of products) {
        let name = product.getAttribute("data-name").toLowerCase();
        let price = product.getAttribute("data-price").toLowerCase();
        
        console.log(`Product - Name: ${name}, Price: ${price}`);
        
        // Show product if it matches input (name or price)
        if (name.includes(input) || price.includes(input)) {
            product.style.display = "";
        } else {
            product.style.display = "none";
        }
    }

    // If input is empty, show all products
    if (input === "") {
        for (let product of products) {
            product.style.display = "";
        }
    }
}
</script>  
