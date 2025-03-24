<?php
$categories_name = [
    'Nut' => 'Nut Products',
    'Powder' => 'Powder Products',
    'Drinks' => 'Drinks Products'
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    header("Content-Type: application/json");

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        $targetDir = "Assets/images/uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($fileType, $allowedTypes)) {
            echo json_encode(["success" => false, "message" => "Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed."]);
            exit;
        }

        if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true)) {
            echo json_encode(["success" => false, "message" => "Failed to create upload directory."]);
            exit;
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            echo json_encode(["success" => true, "message" => "File uploaded successfully!", "image" => $targetFilePath]);
        } else {
            echo json_encode(["success" => false, "message" => "Error moving the uploaded file."]);
        }
    } else {
        $errorMessages = [
            UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the server limit.",
            UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the form limit.",
            UPLOAD_ERR_PARTIAL => "The file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE => "No file was uploaded.",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
            UPLOAD_ERR_EXTENSION => "File upload stopped by a PHP extension."
        ];

        $errorCode = $_FILES["image"]["error"];
        $errorMessage = $errorMessages[$errorCode] ?? "An unknown error occurred.";
        echo json_encode(["success" => false, "message" => $errorMessage]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 transition duration-300"
                     :style="{ backgroundColor: bgColor }">
                    <div class="flex flex-wrap gap-8 p-4 justify-between">
                        <h1 class="text-left ml-1 text-3xl font-bold">Products</h1>
                        <select class="pr-5 pl-2 border border-gray-300 rounded-md transition duration-300 mr-1 bg-white" 
                                onchange="filterByCategory(this.value)">
                            <option value="#">All Products</option>
                            <?php foreach ($categories_name as $key => $value): ?>
                                <option value="<?= $key ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="container flex flex-wrap gap-8 p-4 justify-center" id="productContainer">
                        <?php
                        $products = [
                            ["name" => "Arabica Brazil", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Brazil.png", "category" => "Nut"],
                            ["name" => "Arabica Ethiopia", "price" => "$0.75", "stock" => "Out of stock", "image" => "../../Assets/images/Nut_product/Arabica Ethiopia.png", "category" => "Nut"], // Changed to test
                            ["name" => "Baych Bleand", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Baych_bleand.jpg", "category" => "Nut"],
                            ["name" => "Brown Sugar", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Brown_sugar.jpg", "category" => "Powder"],
                            ["name" => "Flores Bajawa", "price" => "$3.00", "stock" => "Out of stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa_arabica.jpg", "category" => "Nut"], // Changed to test
                            ["name" => "Flores Bajawa", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa.jpg", "category" => "Nut"],
                            ["name" => "Popping Pearls", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Popping_Pearls_Blueberry.jpg", "category" => "Drinks"],
                            ["name" => "Strawberry Puree", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Strawberry.jpg", "category" => "Drinks"],
                            ["name" => "White Boba", "price" => "$1.25", "stock" => "Out of stock", "image" => "../../Assets/images/Nut_product/White_boba.jpg", "category" => "Drinks"], // Changed to test
                            ["name" => "White Crystal", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/White_crystal.jpg", "category" => "Powder"],
                            ["name" => "Popping Boba", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Popping_boba_strawberry.jpg", "category" => "Drinks"],
                            ["name" => "Boba Drink Mix.", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/boba_drink_mix.jpg", "category" => "Drinks"],
                        ];

                        foreach ($products as $index => $product) {
                            $isInStock = $product['stock'] === "In stock";
                            echo '<div class="w-48 h-72 bg-white border border-gray-300 p-4 rounded-lg shadow-md transition duration-300 flex flex-col items-center" data-category="' . htmlspecialchars($product['category']) . '">';
                            echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="w-28 h-28 rounded-md mb-1 mt-1">';
                            echo '<h4 class="text-lg font-bold">' . htmlspecialchars($product['name']) . '</h4>';
                            echo '<p class="text-sm font-semibold ' . ($isInStock ? 'text-green-600' : 'text-red-600') . '">' . htmlspecialchars($product['stock']) . '</p>';
                            echo '<p class="text-sm font-semibold text-yellow-600">' . htmlspecialchars($product['price']) . '</p>';
                            echo '<button class="mt-3 border px-8 py-2 ' . ($isInStock ? 'bg-blue-500 hover:bg-blue-600' : 'bg-gray-400 cursor-not-allowed') . ' text-white font-semibold rounded-md transition show-order-modal" 
                                  data-product-id="' . $index . '"
                                  data-product-name="' . htmlspecialchars($product['name']) . '"
                                  data-product-image="' . htmlspecialchars($product['image']) . '"
                                  data-product-price="' . floatval(str_replace('$', '', $product['price'])) . '"
                                  data-stock="' . htmlspecialchars($product['stock']) . '"
                                  ' . ($isInStock ? '' : 'disabled') . '>
                                  <i class="fas fa-shopping-cart mr-2" style="color: orange;"></i> ORDER</button>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal HTML -->
    <div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-end pr-10 z-50">
        <div class="bg-white rounded-lg p-6 w-96">
            <div class="flex flex-col items-center">
                <img id="modalProductImage" src="" alt="" class="w-32 h-32 rounded-md mb-4">
                <h3 id="modalProductName" class="text-xl font-bold mb-2"></h3>
                <p id="modalProductPrice" class="text-yellow-600 font-semibold mb-2"></p>
                <div class="mb-4 w-full flex justify-center items-center space-x-2">
                    <label for="quantity" class="text-lg font-semibold text-gray-700 self-center">Quantity:</label>
                    <input type="number" id="quantity" min="1" value="1"
                           class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 w-20 text-center">
                </div>
                <p class="text-lg font-semibold mb-4">Total: <span style="color: #D4AF37;">$</span><span id="totalPrice" style="color: #D4AF37;">0.00</span></p>
                <div class="flex gap-4">
                    <button id="cancelBtn" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">CANCEL</button>
                    <button id="orderBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">ORDER</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add alert container -->
    <div id="alertContainer" class="fixed bottom-5 right-0 z-50"></div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('orderModal');
        const modalImage = document.getElementById('modalProductImage');
        const modalName = document.getElementById('modalProductName');
        const modalPrice = document.getElementById('modalProductPrice');
        const quantityInput = document.getElementById('quantity');
        const totalPriceSpan = document.getElementById('totalPrice');
        const cancelBtn = document.getElementById('cancelBtn');
        const orderBtn = document.getElementById('orderBtn');
        const alertContainer = document.getElementById('alertContainer');
        let currentPrice = 0;
        let currentStock = '';

        function showAlert(message, type = 'error') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `flex justify-between items-center max-w-xs mr-5 p-4 rounded-md shadow-md border-l-4 ${
                type === 'success' ? 'bg-green-100 border-green-500 text-green-800' : 'bg-red-100 border-red-500 text-red-800'
            } animate-[slideIn_0.5s_ease_forwards]`;
            alertDiv.innerHTML = `
                <div class="flex-1">${message}</div>
                <button class="ml-4 bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600 transition">OK</button>
            `;

            alertContainer.appendChild(alertDiv);

            alertDiv.querySelector('button').addEventListener('click', () => {
                alertDiv.classList.remove('animate-[slideIn_0.5s_ease_forwards]');
                alertDiv.classList.add('animate-[slideOut_0.5s_ease_forwards]');
                setTimeout(() => alertDiv.remove(), 500);
            });

            setTimeout(() => {
                if (alertDiv.parentElement) {
                    alertDiv.classList.remove('animate-[slideIn_0.5s_ease_forwards]');
                    alertDiv.classList.add('animate-[slideOut_0.5s_ease_forwards]');
                    setTimeout(() => alertDiv.remove(), 500);
                }
            }, 5000);
        }

        document.querySelectorAll('.show-order-modal').forEach(button => {
            button.addEventListener('click', function() {
                const productName = this.getAttribute('data-product-name');
                const productImage = this.getAttribute('data-product-image');
                const productPrice = parseFloat(this.getAttribute('data-product-price'));
                currentStock = this.getAttribute('data-stock');

                modalImage.src = productImage;
                modalName.textContent = productName;
                modalPrice.textContent = `$${productPrice.toFixed(2)}`;
                currentPrice = productPrice;
                quantityInput.value = 1;
                updateTotalPrice();

                // Enable/disable ORDER button in modal based on stock
                orderBtn.disabled = currentStock !== 'In stock';
                orderBtn.classList.toggle('bg-gray-400', currentStock !== 'In stock');
                orderBtn.classList.toggle('bg-blue-500', currentStock === 'In stock');
                orderBtn.classList.toggle('hover:bg-blue-600', currentStock === 'In stock');
                orderBtn.classList.toggle('cursor-not-allowed', currentStock !== 'In stock');

                modal.classList.remove('hidden');
            });
        });

        quantityInput.addEventListener('input', function() {
            updateTotalPrice();
        });

        cancelBtn.addEventListener('click', function() {
            modal.classList.add('hidden');
        });

        orderBtn.addEventListener('click', function() {
            if (currentStock !== 'In stock') {
                showAlert('Cannot order: Product is out of stock', 'error');
                return;
            }

            const quantity = parseInt(quantityInput.value) || 1;
            const productName = modalName.textContent;
            const total = (currentPrice * quantity).toFixed(2);

            fetch('http://localhost:88/products/order', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    productName: productName,
                    quantity: quantity,
                    total: total
                })
            })
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    sessionStorage.setItem('orderDetails', JSON.stringify({
                        productName: productName,
                        quantity: quantity,
                        total: total
                    }));
                    showAlert('Order placed successfully!', 'success');
                    setTimeout(() => window.location.href = '/order', 500);
                } else {
                    showAlert('Error placing order: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('An error occurred while placing the order: ' + error.message, 'error');
            });
        });

        function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value) || 0;
            const total = (currentPrice * quantity).toFixed(2);
            totalPriceSpan.textContent = total;
        }

        function filterByCategory(category) {
            const products = document.querySelectorAll('#productContainer > div');
            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                product.style.display = (category === '#' || productCategory === category) ? '' : 'none';
            });
        }
    });
    </script>
</body>
</html>