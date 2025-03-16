<?php
require_once '../layout/navbarPages/header_user.php';
require_once '../layout/navbarPages/nav_user.php';

?>

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

<style>

</style>


<?php
require_once '../layout/navbarPages/footer_user.php';
?>