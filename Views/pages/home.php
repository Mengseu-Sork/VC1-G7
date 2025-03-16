<?php
require_once (__DIR__ . '/../layout/navbarUser/header_user.php');
require_once (__DIR__ . '/../layout/navbarUser/nav_user.php');


?>


<?php  
// Sample product data  
$products = [  
    'drinks' => [  
        [  
            'name' => 'Coffee',  
            'image' => '../../Assets/images/coffee-coffee.jpg',  
            'link' => '../../Views/pages/products.php'  
        ],  
        [  
            'name' => 'Borey Cafe',  
            'image' => '../../Assets/images/borey-cafe.jpg',  
            'link' => '../../Views/pages/products.php'  
        ],  
        [  
            'name' => 'Juice',  
            'image' => '../../Assets/images/juice.jpg',  
            'link' => '../../Views/pages/products.php'  
        ],  
        [  
            'name' => 'Drink Can',  
            'image' => '../../Assets/images/drink-can.jpg',  
            'link' => '../../Views/pages/products.php'  
        ],  
    ],  
    'flour_products' => [  
        [  
            'name' => 'Sugar',  
            'image' => '../../Assets/images/sugar.jpg',  
            'link' => '../../Views/pages/flour_products.php'  
        ],  
        [  
            'name' => 'Coconut Powder',  
            'image' => '../../Assets/images/powder.jpg',  
            'link' => '../../Views/pages/flour_products.php'  
        ],  
        [  
            'name' => 'Green Tea Powder',  
            'image' => '../../Assets/images/green-tea-power.jpg',  
            'link' => '../../Views/pages/flour_products.php'  
        ],  
        [  
            'name' => 'Coca Powder',  
            'image' => '../../Assets/images/coca-powder.png',  
            'link' => '../../Views/pages/flour_products.php'  
        ],  
    ],  
    'nut_products' => [  
        [  
            'name' => 'Milk',  
            'image' => '../../Assets/images/Milk.jpg',  
            'link' => '../../Views/pages/nut_products.php'  
        ],  
        [  
            'name' => 'Noodles',  
            'image' => '../../Assets/images/noodles.jpg',  
            'link' => '../../Views/pages/nut_products.php'  
        ],  
        [  
            'name' => 'Chocolate',  
            'image' => '../../Assets/images/chocolate.jpg',  
            'link' => '../../Views/pages/nut_products.php'  
        ],  
        [  
            'name' => 'Nabati',  
            'image' => '../../Assets/images/nabati.jpg',  
            'link' => '../../Views/pages/nut_products.php'  
        ],  
    ],  
];  
?>  

<div class="mx-auto p-6">  
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">  
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">  
            <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">  
                <!-- Products -->  
                <div>  
                    <h2 class="text-xl font-bold mb-6">All-Products</h2>  
                    
                    <?php foreach ($products as $category => $items): ?>  
                        <div class="mb-8">  
                            <h3 class="text-lg font-semibold mb-4 pb-2 border-b"><?= ucfirst(str_replace('_', ' ', $category)); ?></h3>  
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">  
                                <?php foreach ($items as $product): ?>  
                                    <div class="bg-white rounded-lg shadow p-4">  
                                        <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" class="w-full h-40 object-cover rounded-lg mb-4">  
                                        <h4 class="text-center font-medium mb-2"><?= $product['name']; ?></h4>  
                                        <a href="<?= $product['link']; ?>">  
                                            <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View more</button>  
                                        </a>  
                                    </div>  
                                <?php endforeach; ?>  
                            </div>  
                        </div>  
                    <?php endforeach; ?>  
                    
                </div>  
            </div>  
        </div>  
    </div>  
</div>  

<?php
require_once (__DIR__ . '/../layout/navbarUser/footer_user.php');
?>