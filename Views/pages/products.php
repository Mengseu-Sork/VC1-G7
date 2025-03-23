<?php
$categories_name = [
    'Nut' => 'Nut Products',
    'Powder' => 'Powder Products',
    'Drinks' => 'Drinks Products'
];

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
<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                
                <div class="flex flex-wrap gap-8 p-4 justify-between">
                    <h1 class="text-left ml-1 text-3xl font-bold ">Products</h1>
                    <select class="pr-5 pl-2 border border-gray-300 rounded-md transition duration-300 mr-1 bg-white dark:bg-darker border-b dark:border-primary-darker" onchange="filterByCategory(this.value)">
                        <option value="#">All Products</option>
                        <?php foreach ($categories_name as $key => $value): ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>  
                    </select>
                </div>
                <div class="container flex flex-wrap gap-8 p-4 justify-center " id="productContainer">
                    <?php  
                    $products = [  
                        ["name" => "Arabica Brazil", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Brazil.png"],  
                        ["name" => "Arabica Ethiopia", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Ethiopia.png"],  
                        ["name" => "Baych Bleand", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Baych_bleand.jpg"],  
                        ["name" => "Brown Sugar", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Brown_sugar.jpg"],  
                        ["name" => "Flores Bajawa", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa_arabica.jpg"],  
                        ["name" => "Flores Bajawa", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa.jpg"],  
                        ["name" => "Popping Pearls", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Popping_Pearls_Blueberry.jpg"],  
                        ["name" => "Strawberry Puree", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Strawberry.jpg"],  
                        ["name" => "White Boba", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/White_boba.jpg"],  
                        ["name" => "White Crystal", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/White_crystal.jpg"],  
                        ["name" => "Popping Boba", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Popping_boba_strawberry.jpg"],  
                        ["name" => "Boba Drink Mix.", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/boba_drink_mix.jpg"],  
                    ];  

                    foreach ($products as $product) {  
                        echo '<div class="w-48 h-72 bg-white border border-gray-300 p-4 rounded-lg shadow-md transition duration-300 flex flex-col items-center bg-white dark:bg-darker border-b dark:border-primary-darker">';
                        echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="w-28 h-28 rounded-md mb-1 mt-1">';
                        echo '<h4 class="text-lg font-bold">' . htmlspecialchars($product['name']) . '</h4>';
                        echo '<p class="text-gl text-green-600 font-semibold">' . htmlspecialchars($product['stock']) . '</p>';
                        echo '<p class="text-gl font-semibold text-yellow-600">' . htmlspecialchars($product['price']) . '</p>';
                        echo '<button class="mt-3 border px-8 py-2 bg-blue-500 relative dark:bg-darker border-b dark:border-primary-darker hover:bg-blue-600 text-white font-semibold rounded-md transition"><i class="fas fa-shopping-cart mr-2" style="color: orange;"></i> ORDER</button>';  
                        echo '</div>';
                        
                    }        
                    ?>  
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