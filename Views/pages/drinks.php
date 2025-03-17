<?php
require_once (__DIR__ . '/../layout/navbarUser/header_user.php');
require_once (__DIR__ . '/../layout/navbarUser/nav_user.php');


?>

<h1>Drinks</h1>

<div class="container" id="productContainer">
    <?php  
    $products = [  
        ["name" => "Apple Soda", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/drinks/Apple_soda.jpg"],  
        ["name" => "Cocacola", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/drinks/Coca-cola.jpg"],  
        ["name" => "Coca", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Coca.jpg"],  
        ["name" => "Fanta", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Fanta.jpg"],  
        ["name" => "Honey Lemon", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Honey_lemon.jpg"],  
        ["name" => "Mango Juice", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Mango_juice.jpg"],  
        ["name" => "Orange Soda", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/orange_soda.jpg"],  
        ["name" => "Pepsi", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Pepsi.jpg"],  
        ["name" => "Sprite", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Sprite.jpg"],  
        ["name" => "Sting", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Sting.jpg"],  
        ["name" => "Naturalist", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/drinks/Naturalist.jpg"],  
        ["name" => "Pineapple Drink", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/drinks/Pineapple_drink.jpg"],  
    ];  

    foreach ($products as $product) {  
        echo '<div class="product">';  
        echo '<img src="' . ($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="product-image">';  
        echo '<div class="product-info">';  
        echo '<h3 class="product-name">' . ($product['name']) . '</h3>';  
        echo '<p class="stock">' . ($product['stock']) . '</p>';  
        echo '<p class="price">' . ($product['price']) . '</p>';  
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
require_once (__DIR__ . '/../layout/navbarUser/footer_user.php');
?>
