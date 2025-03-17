<?php
<<<<<<< HEAD
// session_start();
// if (!isset($_SESSION["user"])) {
//     header("Location: /signin");
//     exit();
// }
=======
require_once (__DIR__ . '/../layout/navbarUser/header_user.php');
require_once (__DIR__ . '/../layout/navbarUser/nav_user.php');

>>>>>>> 5422fc5bc23e3e0474d1f45e2f4b77a0b5497c64

require_once __DIR__ . '/../layout/customer/header_user.php';
require_once __DIR__ . '/../layout/customer/nav_user.php';
require_once __DIR__ . '/../layout/customer/footer_user.php';
?>
    <header class="flex-1 relative bg-white dark:bg-darker">
                <div class="flex items-center justify-between p-2 border-b dark:border-primary-darker">
                    <button
                        @click="isMobileMainMenuOpen = !isMobileMainMenuOpen"
                        class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring"
                    >
                        <span class="sr-only">Open main manu</span>
                        <span aria-hidden="true">
                        <svg
                            class="w-8 h-8"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        </span>
                    </button>
                    <a
                        href="#"
                        class="inline-block text-2xl font-bold tracking-wider uppercase text-primary-dark dark:text-light"
                    >
                    </a>

                    <button
                        @click="isMobileSubMenuOpen = !isMobileSubMenuOpen"
                        class="p-1 transition-colors duration-200 rounded-md text-primary-lighter bg-primary-50 hover:text-primary hover:bg-primary-100 dark:hover:text-light dark:hover:bg-primary-dark dark:bg-dark md:hidden focus:outline-none focus:ring"
                    >
                        <span class="sr-only">Open sub manu</span>
                        <span aria-hidden="true">
                        <svg
                            class="w-8 h-8"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                            />
                        </svg>
                        </span>
                    </button>

<?php  
 
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
