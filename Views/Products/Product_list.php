<?php

// Handle form submissions for file uploads
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
            <div class="shadow-lg rounded-lg mb-16 p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-left ml-1 text-2xl font-bold mb-6">Products List</h2>
                <div class="flex justify-between flex-col md:flex-row items-center gap-4 mb-6">
                    <a href="/products/create">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">Add Product</button>
                    </a>
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
                </div>
                <div class="overflow-x-auto bg-white shadow-lg rounded-lg mt-5">
                    <table id="productsTable" class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-blue-500 text-white uppercase text-xs sm:text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Image</th>
                                <th class="py-3 px-6 text-left">Product Name</th>
                                <th class="py-3 px-6 text-left">Price</th>
                                <th class="py-3 px-6 text-left">Date</th>
                                <th class="py-3 px-6 text-left">
                                    <select name="category-filter" id="category-filter"
                                        class="pr-5 pl-2 border border-blue-300 rounded-md transition duration-300 mr-1 bg-blue-600 border-b dark:border-primary-darker"
                                        onchange="filterByCategory(this.value)">
                                        <option value="">All Categories</option>
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body">
                            <?php foreach ($products as $product): ?>
                                <tr data-category="<?= $product['category_name']; ?>"
                                    class="duration-200 rounded-lg shadow-md transition bg-white dark:text-light dark:bg-darker border-b dark:border-primary-darker">
                                    <td>
                                        <img src="../Assets/images/uploads/<?php echo $product["image"]?>" class="ml-4" alt="" width="40" height="40" style="border-radius: 5px">
                                    </td>
                                    <td class="py-3 px-6 font-semibold"><?php echo $product['name']; ?></td>
                                    <td class="py-3 px-6 font-semibold"><?php echo $product['price']; ?>$</td>
                                    <td class="py-3 px-6 font-semibold"><?php echo $product['date']; ?></td>
                                    <td class="py-3 px-6 font-semibold"><?php echo $product['category_name']; ?></td>
                                    <td class="flex py-3 px-6 font-semibold justify-center relative">
                                        <a href="/products/edit?id=<?= $product['id'] ?>"
                                           class="block px-2 py-2 text-gray-700 flex items-center">
                                            <i class="far fa-edit mr-1" style="color: green;"></i>
                                        </a>

                                        <a href="javascript:void(0)" onclick="openModal('deleteProductModal<?= $product['id'] ?>')"
                                                class="block text-left px-2 py-2 text-gray-700 flex items-center">
                                            <i class="fas fa-trash-alt mr-1" style="color: red"></i>
                                        </a>

                                        <!-- Replace this line: -->
                                        <!-- <a href="../Views/Products/show.php" -->

                                        <!-- With this: -->
                                        <a href="/pages/details?id=<?php echo htmlspecialchars($product['id']); ?>"
                                        class="block px-2 py-2 text-gray-700 flex items-center">
                                            <i class="far fa-eye mr-1" style="color: blue;"></i>
                                        </a>
                                    </td>
                                    <div id="deleteProductModal<?= $product['id'] ?>"
                                         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
                                        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                                            <h2 class="text-lg font-semibold flex justify-center">Delete Product</h2>
                                            <p class="mt-4">Are you sure you want to delete this product?</p>

                                            <div class="mt-6 flex justify-end space-x-2">
                                                <button onclick="closeModal('deleteProductModal<?= $product['id'] ?>')"
                                                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 transition duration-200">
                                                    Cancel
                                                </button>

                                                <a href="/products/delete?id=<?= $product['id'] ?>" 
                                                   class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition duration-200 inline-block text-center">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    function searchProducts() {
        let input = document.getElementById("searchInput").value.toLowerCase().trim();
        let table = document.getElementById("productsTable");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName("td");

            if (cells.length > 0) {
                let name = cells[1].innerText.toLowerCase().trim();
                let price = cells[2].innerText.toLowerCase().trim(); 
                let category = cells[4].innerText.toLowerCase().trim(); 


                if (name.includes(input) || price.includes(input) || category.includes(input)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        if (input === "") {
            for (let i = 1; i < rows.length; i++) {
                rows[i].style.display = "";
            }
        }
    }



    // Filter products by category
    function filterByCategory(category) {
        const rows = document.querySelectorAll("#product-table-body tr");
        rows.forEach(row => {
            const productCategory = row.getAttribute("data-category").toLowerCase();
            if (category === "" || productCategory === category.toLowerCase()) {
                row.style.display = ""; 
            } else {
                row.style.display = "none";
            }
        });
    }

    // Open modal for deletion
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    // Close modal for deletion
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
