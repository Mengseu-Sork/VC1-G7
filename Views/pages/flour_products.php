<?php
require_once (__DIR__ . '/../layout/customer/header_user.php');
require_once (__DIR__ . '/../layout/customer/nav_user.php');
?>

<link rel="stylesheet" href="/Assets/css/order.css">
<h1>Flour Product</h1>

<div class="container" id="productContainer">
    <?php  
   
$products = [  
    ["name" => "Coconot Jerky", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Coconot_jerky.jpg"],  
    ["name" => "Lilactaro YAM", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Lilactaro_YAM.jpg"],  
    ["name" => "Milk Powder", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Milk_powder.jpg"],  
    ["name" => "Mango Puree", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Raw_cacao_powder.jpg"],  
    ["name" => "Blueberry Puree", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Strawberry_powder.jpg"],  
    ["name" => "Strawberry Puree", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Ovaltine.jpg"],  
    ["name" => "Mojito Mint 1883", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Organic_matcha.jpg"],  
    ["name" => "Yogurt Powder (Beverity)", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Raw_cacao_powder.jpg"],  
    ["name" => "Honey Coffee", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Rocc_Strawberry.jpg"],  
    ["name" => "Blue Curacao 1883", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Strawberry_powder.jpg"],  
    ["name" => "Milk Tea Sauce", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Cocoa_powder.jpg"],  
    ["name" => "Arabica Laos", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Milo.jpg"],  
]; 
    foreach ($products as $product) {  
        echo '<div class="product">';  
        echo '<img src="' . ($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';  
        echo '<div class="product-info">';  
        echo '<h3 class="product-name">' . ($product['name']) . '</h3>';  
        echo '<p class="stock">' . ($product['stock']) . '</p>';  
        echo '<p class="price">' . ($product['price']) . '</p>';  
        echo '<div class="options">';  
        echo '<input type="number" id="qty_' . addslashes($product['name']) . '" value="1" min="1">';  
        echo '<select id="size_' . addslashes($product['name']) . '">';  
        echo '<option value="M">M</option>';  
        echo '<option value="L">L</option>';  
        echo '<option value="S">S</option>';  
        echo '</select>';  
        echo '</div>';  
        echo '<button class="order-button" onclick="addToOrder(\'' . addslashes($product['name']) . '\', \'' . addslashes($product['price']) . '\', \'' . addslashes($product['image']) . '\')">Order</button>';  
        echo '</div>'; 
        echo '</div>'; 
    }  
    ?>  
</div>

<!-- Order List Modal -->
<div id="orderForm" style="display: none;" class="order-form">
    <h2>Order List</h2>
    <div id="orderList"></div>
    <div id="order-footer">
        <p>Total Price: $<span id="totalPrice">0.00</span></p>
        <button class="btn1" onclick="submitOrder()">Submit Order</button>
        <button class="btn2" onclick="closeOrderForm()">Cancel</button>
        <p class="note">Scroll to see your another products order</p>
    </div>
</div>


<script src="/Assets/js/order.js"></script>

<?php
require_once (__DIR__ . '/../layout/customer/footer_user.php');
?>