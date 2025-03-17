<?php
require_once (__DIR__ . '/../layout/navbarUser/header_user.php');
require_once (__DIR__ . '/../layout/navbarUser/nav_user.php');
?>

<link rel="stylesheet" href="/Assets/css/order.css">
<title>Product Listing</title>

<h1>Nut Products</h1>

<div class="container" id="productContainer">
    <?php  
    $products = [  
        ["name" => "Arabica Brazil", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Brazil.png"],  
        ["name" => "Arabica Ethiopia", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Ethiopia.png"],  
        ["name" => "Arabica Brazil", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Brazil.png"],  
        ["name" => "Arabica Ethiopia", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Ethiopia.png"],  
        ["name" => "Baych Bleand", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Baych_bleand.jpg"],  
        ["name" => "Brown Sugar", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Brown_sugar.jpg"],  
        ["name" => "Flores Bajawa Arabica", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa_arabica.jpg"], 
        ["name" => "Brown Sugar", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Brown_sugar.jpg"],  
        ["name" => "Flores Bajawa Arabica", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa_arabica.jpg"],   
    ];  

    foreach ($products as $product) {  
        echo '<div class="product">';  
        echo '<img src="' . ($product['image']) . '" alt="' . ($product['name']) . '" class="product-image">';  
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
require_once (__DIR__ . '/../layout/navbarUser/footer_user.php');
?>
