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
                    <?php $isInStock = ($product['stock'] ?? 'In stock') === 'In stock'; ?>
                        <div class="w-48 h-76 border border-gray-300 p-4 rounded-lg shadow-md transition duration-300 flex flex-col items-center border-2 border-gray-200 dark:border-primary-darker"
                            data-category="<?= htmlspecialchars($product['category_name'] ?? 'Uncategorized') ?>"
                            data-name="<?= htmlspecialchars($product['name']) ?>"
                            data-price="<?= htmlspecialchars($product['price']) ?>"
                            data-stock-quantity="<?= htmlspecialchars($product['stock_quantity'] ?? 0) ?>">
                            <div class="product-image-container flex justify-center">
                                <a href="/pages/details?id=<?= htmlspecialchars($product['id']) ?>">
                                    <img src="../Assets/images/uploads/<?= htmlspecialchars($product['image'] ?? 'default.jpg') ?>" 
                                        alt="<?= htmlspecialchars($product['name']) ?>" 
                                        class="w-28 h-28 rounded-md mb-1 mt-1">
                                    <div class="view-more-overlay">View More</div>
                                </a>
                            </div>
                            <h4 class="text-lg font-bold mt-2"><?= htmlspecialchars($product['name']) ?></h4>
                            <span class="category hidden"><?= htmlspecialchars($product['category_name'] ?? '') ?></span>
                            <p class="text-gl font-semibold mt-2 mb-2 <?= $isInStock ? 'text-green-600' : 'text-red-600' ?>">
                                <?= htmlspecialchars($product['stock'] ?? 'In stock') ?>
                            </p>
                            <p class="text-gl font-semibold text-yellow-600">$<?= number_format($product['price'], 2) ?></p>
                            <button class="mt-3 border px-8 py-2 <?= $isInStock ? 'bg-blue-500 hover:bg-blue-600' : 'bg-gray-400 cursor-not-allowed' ?> text-white font-semibold rounded-md transition show-order-modal"
                                data-product-image="<?= htmlspecialchars($product['image']) ?>"
                                data-product-id="<?= htmlspecialchars($product['id']) ?>"
                                data-product-name="<?= htmlspecialchars($product['name']) ?>"
                                data-product-price="<?= $product['price'] ?>"
                                data-stock="<?= htmlspecialchars($product['stock'] ?? 'In stock') ?>"
                                data-stock-quantity="<?= htmlspecialchars($product['stock_quantity'] ?? 0) ?>"
                                <?= $isInStock ? '' : 'disabled' ?>>
                                <i class="fas fa-shopping-cart mr-2" style="color: orange;"></i> ORDER
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>  
            </div>  
        </div>  
    </div>  
</div>  
<!-- Modal HTML -->
<div id="orderModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-end pr-10 z-50">
    <div class="bg-white rounded-lg p-6 w-96 h-[350px] flex flex-col justify-between">
        <div class="modal-content flex flex-col items-center mt-1">
            <img id="modalProductImage" src="" alt="Product Image" class="w-32 h-32 rounded-md mb-4 hidden">
            <p id="modalProductPrice" class="text-yellow-600 font-semibold mb-3"></p>
            <p id="modalStockStatus" class="text-lg font-semibold mb-3"></p>
            <div class="quantity-container mb-3 w-full flex justify-center items-center space-x-2">
                <label for="quantity" class="text-lg font-semibold text-gray-700 self-center">Quantity:</label>
                <input type="number" id="quantity" min="1" value="1"
                       class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 w-20 text-center">
            </div>
            <p class="text-lg font-semibold mb-3">Total: <span style="color: #D4AF37;">$</span><span id="totalPrice" style="color: #D4AF37;">0.00</span></p>
        </div>
        <div class="button-container flex justify-center gap-4 mb-4">
            <button id="cancelBtn" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">CANCEL</button>
            <button id="orderBtn" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">ORDER</button>
        </div>
    </div>
</div>
<!-- Alert Container -->
<div id="alertContainer" class="fixed bottom-5 right-0 z-50"></div>

<!-- Updated JavaScript -->
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

    for (let product of products) {
        let name = product.getAttribute("data-name").toLowerCase();
        let price = product.getAttribute("data-price").toLowerCase();

        console.log(`Product - Name: ${name}, Price: ${price}`);

        if (name.includes(input) || price.includes(input)) {
            product.style.display = "";
        } else {
            product.style.display = "none";
        }
    }

    if (input === "") {
        for (let product of products) {
            product.style.display = "";
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('orderModal');
    const modalImage = document.getElementById('modalProductImage');
    const modalPrice = document.getElementById('modalProductPrice');
    const modalStockStatus = document.getElementById('modalStockStatus');
    const quantityInput = document.getElementById('quantity');
    const totalPriceSpan = document.getElementById('totalPrice');
    const cancelBtn = document.getElementById('cancelBtn');
    const orderBtn = document.getElementById('orderBtn');
    const alertContainer = document.getElementById('alertContainer');
    let currentPrice = 0;
    let currentStock = '';
    let currentProductId = '';
    let currentStockQuantity = 0;

    document.querySelectorAll('.show-order-modal').forEach(button => {
        button.addEventListener('click', function() {
            currentProductId = this.getAttribute('data-product-id');
            const productImage = this.getAttribute('data-product-image');
            currentPrice = parseFloat(this.getAttribute('data-product-price'));
            currentStock = this.getAttribute('data-stock');
            currentStockQuantity = parseInt(this.getAttribute('data-stock-quantity')) || 0;

            // Set modal content
            modalImage.src = `../Assets/images/uploads/${productImage}`;
            modalImage.alt = "Product Image";
            modalImage.classList.remove('hidden');
            modalPrice.textContent = `$${currentPrice.toFixed(2)}`;
            modalStockStatus.textContent = currentStock;
            modalStockStatus.className = `text-lg font-semibold mb-2 ${currentStock === 'In stock' ? 'text-green-600' : 'text-red-600'}`;
            quantityInput.value = 1;
            updateTotalPrice();

            // Handle stock status
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
        modalImage.classList.add('hidden');
    });

    orderBtn.addEventListener('click', function() {
    if (currentStock !== 'In stock') {
        showAlert('Cannot order: Product is out of stock. Please check back later.', 'error');
        return;
    }
    const quantity = parseInt(quantityInput.value) || 1;
    if (quantity <= 0) {
        showAlert('Please enter a valid quantity greater than 0.', 'error');
        return;
    }

    if (currentStockQuantity > 0 && quantity > currentStockQuantity) {
        showAlert(`Cannot order: Only ${currentStockQuantity} items left in stock.`, 'error');
        return;
    }

    const total = (currentPrice * quantity).toFixed(2);

    orderBtn.disabled = true;
    orderBtn.textContent = 'Placing Order...';

    fetch('/products/order', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            productId: currentProductId,
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
            showAlert('Order placed successfully! You will be redirected shortly.', 'success');
            setTimeout(() => window.location.href = '/order', 500);
        } else {
            showAlert('Error placing order: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred: ' + error.message, 'error');
    })
    .finally(() => {
        orderBtn.disabled = currentStock !== 'In stock';
        orderBtn.textContent = 'ORDER';
    });
});

    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value) || 0;
        const total = (currentPrice * quantity).toFixed(2);
        totalPriceSpan.textContent = total;
    }
});
</script>