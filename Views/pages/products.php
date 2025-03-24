<?php
$productModel = new ProductModel();
$products = $productModel->getAllProducts();
$categories_name = [
    'Nut' => 'Nut Products',
    'Powder' => 'Powder Products',
    'Drinks' => 'Drinks Products'
];

$productsPerRow = 5; // Number of products per row
$rowsPerClick = 2; // Show 2 more rows per click
$initialRows = 2; // Initially displayed rows
$initialProductsToShow = $productsPerRow * $initialRows;
$totalProducts = count($products);
?>

<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                
                <div class="flex flex-wrap gap-8 p-4 justify-between">
                    <h1 class="text-left ml-1 text-3xl font-bold">Products</h1>
                    <select class="pr-5 pl-2 border border-gray-300 rounded-md transition duration-300 mr-1 bg-white dark:bg-darker border-b dark:border-primary-darker" onchange="filterByCategory(this.value)">
                        <option value="#">All Products</option>
                        <?php foreach ($categories_name as $key => $value): ?>
                            <option value="<?= $key ?>"><?= $value ?></option>
                        <?php endforeach; ?>  
                    </select>
                </div>

                <div class="container flex flex-wrap gap-8 p-4 justify-center" id="productContainer">
                    <?php 
                    $index = 0;
                    foreach ($products as $product): 
                        $hiddenClass = ($index >= $initialProductsToShow) ? 'hidden product-hidden' : '';
                        $index++;
                    ?>
                        <div class="w-48 h-72 bg-white border border-gray-300 p-4 rounded-lg shadow-md transition duration-300 flex flex-col items-center bg-white dark:bg-darker border-b dark:border-primary-darker <?= $hiddenClass ?>">
                            <img src="../Assets/images/uploads/<?php echo $product["image"]; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="w-28 h-28 rounded-md mb-1 mt-1">
                            <h4 class="text-lg font-bold"><?= htmlspecialchars($product['name']) ?></h4>
                            <p class="text-gl text-green-600 font-semibold"><span class="ml-4 bg-green-200 text-green-800 text-xs font-bold px-3 py-1 rounded-full">In Stock</span></p>
                            <p class="text-gl font-semibold text-yellow-600"><?= htmlspecialchars($product['price']) ?></p>
                            <button class="mt-3 border px-8 py-2 bg-blue-500 relative dark:bg-darker border-b dark:border-primary-darker hover:bg-blue-600 text-white font-semibold rounded-md transition">
                                <i class="fas fa-shopping-cart mr-2" style="color: orange;"></i> ORDER
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Buttons Container -->
                <div class="flex justify-center mt-6 gap-4" id="buttonContainer">
                    <button onclick="showMoreProducts()" id="seeMoreButton" class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 transition">
                        See More
                    </button>
                    <button onclick="resetProducts()" id="backButton" class="px-6 py-2 bg-red-500 text-white font-semibold rounded-md hover:bg-red-600 transition hidden">
                        Back
                    </button>
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

    function showMoreProducts() {
        let hiddenProducts = document.querySelectorAll('.product-hidden');
        let counter = 0;

        hiddenProducts.forEach(product => {
            if (counter < (productsPerRow * rowsPerClick)) {
                product.classList.remove('hidden');
                product.classList.remove('product-hidden');
                counter++;
            }
        });

        shownProducts += counter;

        // Show "Back" button when "See More" is clicked
        document.getElementById('backButton').classList.remove('hidden');

        // Hide the "See More" button if all products are shown
        if (shownProducts >= totalProducts) {
            document.getElementById('seeMoreButton').style.display = 'none';
        }
    }

    function resetProducts() {
        let allProducts = document.querySelectorAll('.container .w-48.h-72');
        allProducts.forEach((product, index) => {
            if (index >= initialProductsToShow) {
                product.classList.add('hidden');
                product.classList.add('product-hidden');
            }
        });

        shownProducts = initialProductsToShow;

        // Show "See More" button again
        document.getElementById('seeMoreButton').style.display = 'block';

        // Hide "Back" button after resetting
        document.getElementById('backButton').classList.add('hidden');
    }
</script>

<style>
    /* Center the button container */
    #buttonContainer {
        display: flex;
        justify-content: center;
        margin-top: 15px;
        margin-bottom: 15px;
        padding: 10px;
    }
</style>
