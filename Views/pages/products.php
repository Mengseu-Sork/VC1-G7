<?php
$productModel = new ProductModel();
$products = $productModel->getAllProducts() ?? [];
$categories_name = [
    'Nut' => 'Nut Products',
    'Powder' => 'Powder Products',
    'Drinks' => 'Drinks Products'
];

$productsPerRow = 5;
$rowsPerClick = 2;
$initialRows = 2;
$initialProductsToShow = $productsPerRow * $initialRows;
$totalProducts = count($products);

// Handle image upload (if applicable)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    header("Content-Type: application/json");
    if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $targetDir = "../../Assets/images/uploads/";
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
        $errorCode = $_FILES["image"]["error"] ?? UPLOAD_ERR_NO_FILE;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
            <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
                <div class="shadow-lg rounded-lg p-6 mb-16 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                    :style="{ backgroundColor: bgColor }">
                    <h1 class="text-left ml-4 text-3xl font-bold">Products</h1>
                    <div class="flex flex-wrap gap-8 p-4 justify-between">
                        <div class="flex w-full md:w-auto gap-2 relative">
                            <input type="text" id="searchInput" placeholder="Search products..."
                                class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 outline-none bg-white dark:bg-darker border-b dark:border-primary-darker">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <button type="button" onclick="searchProducts()"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                                Search
                            </button>
                        </div>
                        <div class="flex space-x-1 text-xl">
                            <a href="../../Views/orders/order.php" class="relative">
                                <i class="fas fa-shopping-cart mr-1" style="color: orange;"></i>
                                <span id="cartCount"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                            </a>
                            <select id="category-filter"
                                class="pr-2 pl-2 border border-gray-200 rounded-md duration-200 bg-white dark:bg-darker border-b dark:border-primary-darker"
                                onchange="filterByCategory(this.value)">
                                <option value="">All Products</option>
                                <?php foreach ($categories_name as $key => $value): ?>
                                    <option value="<?= htmlspecialchars($key) ?>"><?= htmlspecialchars($value) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="container flex flex-wrap gap-8 p-4" id="productContainer">
                        <?php
                        $index = 0;
                        foreach ($products as $product):
                            $hiddenClass = ($index >= $initialProductsToShow) ? 'hidden product-hidden' : '';
                            $isInStock = ($product['stock'] ?? 'In stock') === 'In stock';
                            $categoryName = $product['category_name'] ?? 'Uncategorized';
                            $categoryName = array_key_exists($categoryName, $categories_name) ? $categoryName : 'Uncategorized';
                            ?>
                            <div class="w-64 h-84 bg-white border border-gray-300 p-4 rounded-lg shadow-md transition duration-300 flex flex-col items-center bg-white dark:bg-darker border-b dark:border-primary-darker <?= $hiddenClass ?>"
                                data-category="<?= htmlspecialchars($categoryName) ?>"
                                data-name="<?= htmlspecialchars($product['name'] ?? '') ?>"
                                data-price="<?= htmlspecialchars($product['price'] ?? 0.00) ?>"
                                data-stock-quantity="<?= htmlspecialchars($product['stock_quantity'] ?? 0) ?>">
                                <div class="product-image-container flex justify-center">
                                    <a href="/pages/details?id=<?= htmlspecialchars($product['id'] ?? '') ?>">
                                        <img src="../Assets/images/uploads/<?= htmlspecialchars($product['image'] ?? 'default.jpg') ?>"
                                            alt="<?= htmlspecialchars($product['name'] ?? '') ?>"
                                            class="w-32 h-32 rounded-md mb-1 mt-1">
                                        <div class="view-more-overlay">View More</div>
                                    </a>
                                </div>
                                <h4 class="text-lg font-bold mt-2 font-semibold">
                                    <?= htmlspecialchars($product['name'] ?? 'Unnamed Product') ?>
                                </h4>
                                <p class="text-lg font-semibold mt-2 mb-2"
                                    style="color: <?= $isInStock ? 'green' : 'red' ?>;">
                                    <?= htmlspecialchars($product['stock'] ?? 'In stock') ?>
                                </p>
                                <p class="text-sm font-semibold text-yellow-600 text-center">
                                    $<?= number_format($product['price'] ?? 0.00, 2) ?>
                                </p>
                                <div class="flex gap-3 mt-2">
                                    <button
                                        class="border px-4 py-2 <?= $isInStock ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-400 cursor-not-allowed' ?> text-white font-semibold rounded-md transition add-to-cart flex items-center"
                                        data-product-id="<?= htmlspecialchars($product['id'] ?? '') ?>"
                                        data-product-name="<?= htmlspecialchars($product['name'] ?? '') ?>"
                                        data-product-price="<?= htmlspecialchars($product['price'] ?? 0.00) ?>"
                                        data-product-image="<?= htmlspecialchars($product['image'] ?? 'default.jpg') ?>"
                                        data-stock="<?= htmlspecialchars($product['stock'] ?? 'In stock') ?>"
                                        data-stock-quantity="<?= htmlspecialchars($product['stock_quantity'] ?? 0) ?>"
                                        <?= $isInStock ? '' : 'disabled' ?>>
                                        <i class="fas fa-cart-plus mr-2" style="color: white;"></i> ADD
                                    </button>
                                    <button
                                        class="border px-4 py-2 <?= $isInStock ? 'bg-blue-500 hover:bg-blue-600' : 'bg-gray-400 cursor-not-allowed' ?> text-white font-semibold rounded-md transition show-order-modal flex items-center"
                                        data-product-image="<?= htmlspecialchars($product['image'] ?? 'default.jpg') ?>"
                                        data-product-id="<?= htmlspecialchars($product['id'] ?? '') ?>"
                                        data-product-name="<?= htmlspecialchars($product['name'] ?? '') ?>"
                                        data-product-price="<?= htmlspecialchars($product['price'] ?? 0.00) ?>"
                                        data-stock="<?= htmlspecialchars($product['stock'] ?? 'In stock') ?>"
                                        data-stock-quantity="<?= htmlspecialchars($product['stock_quantity'] ?? 0) ?>"
                                        <?= $isInStock ? '' : 'disabled' ?>>
                                        <i class="fas fa-shopping-cart mr-1" style="color: white;"></i> ORDER
                                    </button>
                                </div>
                            </div>
                            <?php $index++; endforeach; ?>
                    </div>

                    <div class="flex justify-center mt-6 gap-4" id="buttonContainer">
                        <button onclick="showMoreProducts()" id="seeMoreButton"
                            class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition">
                            See More
                        </button>
                        <button onclick="resetProducts()" id="backButton"
                            class="px-6 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-gray-600 transition hidden">
                            Back
                        </button>
                    </div>
                </div>

                <div id="orderModal"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-end pr-10 z-50">
                    <div class="bg-white rounded-lg p-6 w-96 h-[350px] flex flex-col justify-between">
                        <form id="orderForm">
                            <div class="modal-content flex flex-col items-center mt-1">
                                <img id="modalProductImage" src="" alt="Product Image"
                                    class="w-32 h-32 rounded-md mb-4 hidden">
                                <h3 id="modalProductNameDisplay" class="text-lg font-bold mb-3 text-black"></h3>
                                <input type="hidden" id="modalProductName" name="product_name">
                                <input type="hidden" id="modalPrice" name="price">
                                <p id="modalProductPrice" class="text-yellow-600 font-semibold mb-3"></p>
                                <p id="modalStockStatus" class="text-lg font-semibold mb-3"></p>
                                <div class="quantity-container mb-3 w-full flex justify-center items-center space-x-2">
                                    <label for="quantity" class="text-lg font-semibold text-gray-700">Quantity:</label>
                                    <span id="decreaseQty"
                                        class="text-2xl font-bold text-gray-600 cursor-pointer select-none">−</span>
                                    <input type="text" id="quantity" name="quantity" value="1" readonly
                                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 w-16 text-center">
                                    <span id="increaseQty"
                                        class="text-2xl font-bold text-gray-600 cursor-pointer select-none">+</span>
                                </div>
                                <p class="text-lg font-semibold mb-3">Total: <span style="color: #D68C1E;">$</span>
                                    <span id="totalPrice" style="color: #D68C1E;">0.00</span>
                                </p>
                            </div>
                            <div class="button-container flex justify-center gap-4 mb-4">
                                <button type="button" id="cancelBtn"
                                    class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">CANCEL</button>
                                <button type="button" id="orderBtn"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">ORDER</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="successMessage"
                    class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50 hidden z-50">
                    <div class="bg-white w-80 p-6 rounded-lg shadow-lg text-center">
                        <h2 id="successMessageTitle" class="text-xl font-bold mb-4"></h2>
                        <button id="closeSuccess"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let productsPerRow = <?= $productsPerRow ?>;
        let rowsPerClick = <?= $rowsPerClick ?>;
        let initialProductsToShow = <?= $initialProductsToShow ?>;
        let shownProducts = initialProductsToShow;
        const totalProducts = <?= $totalProducts ?>;
        // Note: loggedInUserId is not defined since we removed session handling
        const loggedInUserId = null; // You may need to define this differently

        function updateCartCount() {
            const cart = getCart();
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            document.getElementById('cartCount').textContent = totalItems;
        }

        function getCart() {
            const cart = localStorage.getItem('cart');
            return cart ? JSON.parse(cart) : [];
        }

        function saveCart(cart) {
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
        }

        function showSuccessMessage(message, isError = false) {
            const successMessageTitle = document.getElementById('successMessageTitle');
            const successMessage = document.getElementById('successMessage');
            successMessageTitle.textContent = message;
            // Apply different styling based on whether it's an error or success message
            successMessageTitle.className = `text-xl font-bold mb-4 ${isError ? 'text-red-600' : 'text-green-600'}`;
            successMessage.classList.remove('hidden');
        }

        function filterByCategory(category) {
            const productCards = document.querySelectorAll("#productContainer .w-64");
            let visibleCount = 0;

            productCards.forEach(card => {
                const productCategory = card.getAttribute("data-category")?.toLowerCase() || "";
                const shouldShow = !category || productCategory === category.toLowerCase();

                if (shouldShow) {
                    card.classList.remove("hidden", "product-hidden");
                    card.style.display = "";
                    visibleCount++;
                } else {
                    card.style.display = "none";
                }
            });

            const seeMoreButton = document.getElementById("seeMoreButton");
            const backButton = document.getElementById("backButton");
            seeMoreButton.style.display = category ? "none" : (shownProducts < totalProducts ? "" : "none");
            backButton.style.display = category ? "none" : (shownProducts > initialProductsToShow ? "" : "none");

            if (!category) {
                resetProducts();
            }
        }

        function searchProducts() {
            const input = document.getElementById("searchInput").value.toLowerCase().trim();
            const products = document.querySelectorAll("#productContainer .w-64");
            const seeMoreButton = document.getElementById("seeMoreButton");
            const backButton = document.getElementById("backButton");

            let visibleCount = 0;

            products.forEach(product => {
                const name = product.getAttribute("data-name")?.toLowerCase() || "";
                const price = product.getAttribute("data-price")?.toLowerCase() || "";
                const category = product.getAttribute("data-category")?.toLowerCase() || "";

                const isMatch = name.includes(input) || price.includes(input) || category.includes(input);

                if (isMatch) {
                    product.classList.remove("hidden", "product-hidden");
                    product.style.display = "";
                    visibleCount++;
                } else {
                    product.style.display = "none";
                }
            });

            seeMoreButton.style.display = input ? "none" : (shownProducts < totalProducts ? "" : "none");
            backButton.style.display = input ? "none" : (shownProducts > initialProductsToShow ? "" : "none");

            if (!input) {
                resetProducts();
            }
        }

        function showMoreProducts() {
            const products = document.querySelectorAll("#productContainer .w-64");
            const seeMoreButton = document.getElementById("seeMoreButton");
            const backButton = document.getElementById("backButton");

            shownProducts += productsPerRow * rowsPerClick;
            products.forEach((product, index) => {
                if (index < shownProducts) {
                    product.classList.remove("hidden", "product-hidden");
                    product.style.display = "";
                }
            });

            seeMoreButton.style.display = shownProducts >= totalProducts ? "none" : "";
            backButton.style.display = "";
        }

        function resetProducts() {
            const products = document.querySelectorAll("#productContainer .w-64");
            const seeMoreButton = document.getElementById("seeMoreButton");
            const backButton = document.getElementById("backButton");

            shownProducts = initialProductsToShow;
            products.forEach((product, index) => {
                if (index < initialProductsToShow) {
                    product.classList.remove("hidden", "product-hidden");
                    product.style.display = "";
                } else {
                    product.classList.add("hidden", "product-hidden");
                    product.style.display = "none";
                }
            });

            seeMoreButton.style.display = totalProducts > initialProductsToShow ? "" : "none";
            backButton.style.display = "none";
        }

        document.addEventListener('DOMContentLoaded', function () {
            const elements = {
                modal: document.getElementById('orderModal'),
                modalImage: document.getElementById('modalProductImage'),
                modalPrice: document.getElementById('modalProductPrice'),
                modalStockStatus: document.getElementById('modalStockStatus'),
                modalProductNameDisplay: document.getElementById('modalProductNameDisplay'),
                quantityInput: document.getElementById('quantity'),
                totalPriceSpan: document.getElementById('totalPrice'),
                cancelBtn: document.getElementById('cancelBtn'),
                orderBtn: document.getElementById('orderBtn'),
                modalProductName: document.getElementById('modalProductName'),
                modalPriceInput: document.getElementById('modalPrice'),
                orderForm: document.getElementById('orderForm'),
                successMessage: document.getElementById('successMessage'),
                closeSuccess: document.getElementById('closeSuccess'),
                increaseQty: document.getElementById("increaseQty"),
                decreaseQty: document.getElementById("decreaseQty"),
                searchInput: document.getElementById("searchInput")
            };

            let currentPrice = 0;
            let currentStock = '';
            let currentStockQuantity = 0;

            updateCartCount();

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const product = {
                        id: this.getAttribute('data-product-id'),
                        name: this.getAttribute('data-product-name'),
                        price: parseFloat(this.getAttribute('data-product-price')),
                        image: this.getAttribute('data-product-image'),
                        stock: this.getAttribute('data-stock'),
                        stock_quantity: parseInt(this.getAttribute('data-stock-quantity'))
                    };

                    let cart = getCart();
                    const existingItem = cart.find(item => item.id === product.id);
                    if (existingItem) {
                        existingItem.quantity += 1;
                        if (existingItem.quantity > existingItem.stock_quantity) {
                            existingItem.quantity = existingItem.stock_quantity;
                            showSuccessMessage('Maximum stock quantity reached!', true);
                            return;
                        }
                    } else {
                        product.quantity = 1;
                        cart.push(product);
                    }
                    saveCart(cart);
                    showSuccessMessage('Product Added to Order!');
                });
            });

            function updateTotalPrice() {
                const quantity = parseInt(elements.quantityInput.value) || 1;
                elements.totalPriceSpan.textContent = (currentPrice * quantity).toFixed(2);
            }

            elements.searchInput.addEventListener('input', searchProducts);

            document.querySelectorAll('.show-order-modal').forEach(button => {
                button.addEventListener('click', function () {
                    const productName = this.getAttribute('data-product-name');
                    const productImage = this.getAttribute('data-product-image');
                    const productId = this.getAttribute('data-product-id');
                    currentPrice = parseFloat(this.getAttribute('data-product-price')) || 0;
                    currentStock = this.getAttribute('data-stock');
                    currentStockQuantity = parseInt(this.getAttribute('data-stock-quantity')) || 0;

                    document.getElementById('modalProductId')?.remove();
                    const productIdInput = document.createElement('input');
                    productIdInput.type = 'hidden';
                    productIdInput.id = 'modalProductId';
                    productIdInput.name = 'product_id';
                    productIdInput.value = productId;
                    elements.orderForm.appendChild(productIdInput);

                    elements.modalProductName.value = productName;
                    elements.modalPriceInput.value = currentPrice;
                    elements.modalImage.src = `../Assets/images/uploads/${productImage}`;
                    elements.modalImage.classList.remove('hidden');
                    elements.modalPrice.textContent = `$${currentPrice.toFixed(2)}`;
                    elements.modalStockStatus.textContent = currentStock;
                    elements.modalStockStatus.className = `text-lg font-semibold mb-2 ${currentStock === 'In stock' ? 'text-green-600' : 'text-red-600'}`;
                    elements.modalProductNameDisplay.textContent = productName;
                    elements.quantityInput.value = 1;
                    updateTotalPrice();

                    elements.orderBtn.disabled = currentStock !== 'In stock';
                    elements.orderBtn.classList.toggle('bg-gray-400', currentStock !== 'In stock');
                    elements.orderBtn.classList.toggle('bg-blue-500', currentStock === 'In stock');
                    elements.modal.classList.remove('hidden');
                });
            });

            elements.quantityInput.addEventListener("input", function () {
                let quantity = parseInt(elements.quantityInput.value) || 1;
                if (quantity < 1) quantity = 1;
                if (currentStockQuantity > 0 && quantity > currentStockQuantity) quantity = currentStockQuantity;
                elements.quantityInput.value = quantity;
                updateTotalPrice();
            });

            elements.increaseQty.addEventListener("click", function () {
                let quantity = parseInt(elements.quantityInput.value) || 1;
                if (currentStockQuantity > 0 && quantity >= currentStockQuantity) return;
                elements.quantityInput.value = quantity + 1;
                updateTotalPrice();
            });

            elements.decreaseQty.addEventListener("click", function () {
                let quantity = parseInt(elements.quantityInput.value) || 1;
                if (quantity > 1) {
                    elements.quantityInput.value = quantity - 1;
                    updateTotalPrice();
                }
            });

            elements.cancelBtn.addEventListener('click', function () {
                elements.modal.classList.add('hidden');
                elements.modalImage.classList.add('hidden');
            });

            elements.orderBtn.addEventListener('click', function (e) {
                e.preventDefault();

                // Gather product details from the modal
                const quantity = parseInt(elements.quantityInput.value) || 1;
                const productId = document.getElementById('modalProductId')?.value;
                const productName = elements.modalProductName.value;
                const price = parseFloat(elements.modalPriceInput.value);
                const productImage = elements.modalImage.src.split('/').pop(); // Extract the image filename
                const stock = elements.modalStockStatus.textContent;
                const stockQuantity = currentStockQuantity; // Already set when modal is opened

                // Create product object
                const product = {
                    id: productId,
                    name: productName,
                    price: price,
                    image: productImage,
                    stock: stock,
                    stock_quantity: stockQuantity,
                    quantity: quantity
                };

                // Add to cart (same logic as "ADD" button)
                let cart = getCart();
                const existingItem = cart.find(item => item.id === product.id);
                if (existingItem) {
                    existingItem.quantity += quantity;
                    if (existingItem.quantity > existingItem.stock_quantity) {
                        existingItem.quantity = existingItem.stock_quantity;
                        showSuccessMessage('Maximum stock quantity reached!', true);
                        return;
                    }
                } else {
                    cart.push(product);
                }

                // Save the updated cart and update cart count
                saveCart(cart);

                // Close the modal
                elements.modal.classList.add('hidden');
                elements.modalImage.classList.add('hidden');

                // Redirect to the cart page immediately
                window.location.href = '/Views/orders/order.php';
            });

            elements.closeSuccess.addEventListener('click', function () {
                // Close the success message
                elements.successMessage.classList.add('hidden');
                // Close the order modal
                elements.modal.classList.add('hidden');
                elements.modalImage.classList.add('hidden');
                // Redirect to the products page (reload current page)
                window.location.href = window.location.pathname;
            });

            resetProducts();
        });
    </script>
    <style>
        @media (max-width: 1280px) {
            #productContainer {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }
        }

        @media (max-width: 1024px) {
            #productContainer {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            #productContainer {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 480px) {
            #productContainer {
                grid-template-columns: repeat(1, minmax(0, 1fr));
            }
        }
    </style>
</body>

</html>