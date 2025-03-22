
<div class="mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <div class="flex flex-wrap gap-8 p-4 justify-between">
                    <h1 class="text-left text-3xl font-bold pl-1 ">Products</h1>
                    <select class="pr-5 pl-2 border border-gray-300 rounded-md mr-1 transition duration-300 bg-white dark:bg-darker border-b dark:border-primary-darker" onchange="location = this.value;">
                        <option value="#">Drink</option>  
                        <option value="../pages/products.php">All Products</option>  
                        <option value="../pages/flour_products.php">Flour</option>  
                        <option value="../pages/nut_products.php">Nut</option>   
                    </select>
                </div>

                <div class="container flex flex-wrap gap-8 p-2 justify-center" id="productContainer">
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
                        echo '<div class="w-48 h-88 bg-white border border-gray-300 p-4 rounded-lg shadow-md flex flex-col items-center transition duration-300 bg-white dark:bg-darker border-b dark:border-primary-darker">';
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

