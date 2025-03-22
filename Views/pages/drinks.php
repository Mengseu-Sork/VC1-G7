<?php
require_once (__DIR__ . '/../layout/customer/header_user.php');
require_once (__DIR__ . '/../layout/customer/nav_user.php');
?>

<link rel="stylesheet" href="/Assets/css/order.css">
<h1>Drinks</h1>

<div class="container" id="productContainer">
    <?php  
     $products = [  
        ["name" => "Arabica Brazil", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/drinks/Apple_soda.jpg"],  
        ["name" => "Arabica Ethiopia", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/drinks/Coca-cola.jpg"],  
        ["name" => "Baych Bleand", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Coca.jpg"],  
        ["name" => "Brown Sugar", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Fanta.jpg"],  
        ["name" => "Flores Bajawa Arabica", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Honey_lemon.jpg"],  
        ["name" => "Flores Bajawa", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Mango_juice.jpg"],  
        ["name" => "Popping Pearls Blueberry", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/orange_soda.jpg"],  
        ["name" => "Strawberry Puree", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Pepsi.jpg"],  
        ["name" => "White Boba", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Sprite.jpg"],  
        ["name" => "White Crystal", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Sting.jpg"],  
        ["name" => "Milk Tea Sauce", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Naturalist.jpg"],  
        ["name" => "Arabica Laos", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Pineapple_drink.jpg"],  
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
