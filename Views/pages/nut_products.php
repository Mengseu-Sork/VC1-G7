<?php
require_once '../layout/navbarPages/header_user.php';
require_once '../layout/navbarPages/nav_user.php';

?>
 
<h1>Nut Products</h1>

<div class="container" id="productContainer">
    <?php  
    $products = [  
        ["name" => "Arabica Brazil", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Brazil.png"],  
        ["name" => "Arabica Ethiopia", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Arabica Ethiopia.png"],  
        ["name" => "Baych Bleand", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Baych_bleand.jpg"],  
        ["name" => "Brown Sugar", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Brown_sugar.jpg"],  
        ["name" => "Flores Bajawa Arabica", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa_arabica.jpg"],  
        ["name" => "Flores Bajawa", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Flores_bajawa.jpg"],  
        ["name" => "Popping Pearls Blueberry", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Popping_Pearls_Blueberry.jpg"],  
        ["name" => "Strawberry Puree", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Strawberry.jpg"],  
        ["name" => "White Boba", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/White_boba.jpg"],  
        ["name" => "White Crystal", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/White_crystal.jpg"],  
        ["name" => "Popping Boba Strawberry", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/Popping_boba_strawberry.jpg"],  
        ["name" => "Boba Drink Mix.", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/Nut_product/boba_drink_mix.jpg"],  
    ];  

    foreach ($products as $product) {  
        echo '<div class="product">';  
        echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';  
        echo '<div class="product-info">';  
        echo '<h3 class="product-name">' . htmlspecialchars($product['name']) . '</h3>';  
        echo '<p class="stock">' . htmlspecialchars($product['stock']) . '</p>';  
        echo '<p class="price">' . htmlspecialchars($product['price']) . '</p>';  
        echo '<div class="options">';  
        echo '<input type="number" value="1" min="1">';  
        echo '<select>';  
        echo '<option>M</option>';  
        echo '<option>L</option>';  
        echo '<option>S</option>';  
        echo '</select>';  
        echo '</div>';  
        echo '<button class="order-button">Order</button>';  
        echo '</div>'; 
        echo '</div>'; 
    }  
    ?>  
</div>

<script>
function filterProducts() {
    let input = document.getElementById('search').value.toLowerCase();
    let products = document.getElementsByClassName('product');
    
    for (let i = 0; i < products.length; i++) {
        let productName = products[i].getElementsByClassName('product-name')[0].innerText.toLowerCase();
        if (productName.includes(input)) {
            products[i].style.display = "flex";
        } else {
            products[i].style.display = "none";
        }
    }
}
</script>
 


<?php
require_once '../layout/navbarPages/footer_user.php';
?>
