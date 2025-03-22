
<div class="mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <div class="flex flex-wrap gap-8 p-4 justify-between">
                    <h1 class="text-left text-3xl font-bold pl-1 ">Products</h1>
                    <select class="pr-5 pl-2 border border-gray-300 rounded-md mr-1 transition duration-300 bg-white dark:bg-darker border-b dark:border-primary-darker" onchange="location = this.value;">
                        <option value="#">Flour</option>  
                        <option value="../pages/products.php">All Products</option>   
                        <option value="../pages/drinks.php">Drink</option>  
                        <option value="../pages/nut_products.php">Nut</option>  
                    </select>
                </div>
                <div class="container flex flex-wrap gap-8 p-2 justify-center" id="productContainer">
                    <?php  
                    $products = [  
                        ["name" => "Coconot Jerky", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Coconot_jerky.jpg"],  
                        ["name" => "Lilactaro YAM", "price" => "$0.75", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Lilactaro_YAM.jpg"],  
                        ["name" => "Milk Powder", "price" => "$1.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Milk_powder.jpg"],  
                        ["name" => "Mango Puree", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Raw_cacao_powder.jpg"],  
                        ["name" => "Blueberry", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Strawberry_powder.jpg"],  
                        ["name" => "Strawberry", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Ovaltine.jpg"],  
                        ["name" => "Mojito Mint", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Organic_matcha.jpg"],  
                        ["name" => "Yogurt Powder", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Raw_cacao_powder.jpg"],  
                        ["name" => "Honey Coffee", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Rocc_Strawberry.jpg"],  
                        ["name" => "Blue Curacao", "price" => "$2.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Strawberry_powder.jpg"],  
                        ["name" => "Milk Tea Sauce", "price" => "$3.00", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Cocoa_powder.jpg"],  
                        ["name" => "Arabica Laos", "price" => "$1.25", "stock" => "In stock", "image" => "../../Assets/images/flour_products/Milo.jpg"],  
                    ];  

                    foreach ($products as $product) {  
                        echo '<div class="w-48 h-80 bg-white border border-gray-300 p-4 rounded-lg shadow-md flex flex-col items-center transition duration-300 bg-white dark:bg-darker border-b dark:border-primary-darker">';
                        echo '<img src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '" class="w-28 h-28 rounded-md mb-1 mt-1">';
                        echo '<h4 class="text-lg font-bold">' . htmlspecialchars($product['name']) . '</h4>';
                        echo '<p class="text-gl text-green-600 font-semibold">' . htmlspecialchars($product['stock']) . '</p>';
                        echo '<p class="text-gl font-semibold text-yellow-600">' . htmlspecialchars($product['price']) . '</p>';
                        echo '<div class="options flex gap-4 mt-2">';
                        echo '<input type="number" value="1" min="1" class="w-12 p-1 border border-gray-300 rounded-md text-center relative bg-white dark:bg-darker border-b dark:border-primary-darker">';
                        echo '<select class="p-1 border border-gray-300 rounded-md relative bg-white dark:bg-darker border-b dark:border-primary-darker">';
                        echo '<option>M</option>';  
                        echo '<option>S</option>';  
                        echo '<option>L</option>';  
                        echo '</select>';  
                        echo '</div>';  
                        echo '<button class="mt-3 border px-8 py-2 bg-green-500 relative dark:bg-darker border-b dark:border-primary-darker hover:bg-green-600 text-white font-semibold rounded-md transition">Order</button>';  
                        echo '</div>';
                        
                    }         
                    ?> 
                </div>
            </div>
        </div>
    </div>
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


<?php require_once __DIR__ . '/../layout/customer/footer_user.php';?>