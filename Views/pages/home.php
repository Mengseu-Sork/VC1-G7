<?php
<<<<<<< HEAD
require_once '../layout/navbarPages/header_user.php';
require_once '../layout/navbarPages/nav_user.php';
require_once '../layout/navbarPages/footer_user.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}

$user = $_SESSION['user'];
?>
=======
require_once (__DIR__ . '/../layout/navbarUser/header_user.php');
require_once (__DIR__ . '/../layout/navbarUser/nav_user.php');
require_once (__DIR__ . '/../layout/navbarUser/footer_user.php');

?>


<div class="mx-auto p-6">
<div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
    <!-- Products -->
          <div>
            <h2 class="text-xl font-bold mb-6">All-Products</h2>
            <!-- Drinks Section -->
            <div class="mb-8">
              <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Drinks</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Coffee -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/coffee-coffee.jpg" alt="Coffee" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Coffee</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Cocoa -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/borey-cafe.jpg" alt="Orange" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Borey Cafe</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Juice -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/juice.jpg" alt="Juice" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Juice</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Drink Can -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/drink-can.jpg" alt="Drink Can" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Drink Can</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
              </div>
            </div>
            <!-- Drink Powder Section -->
            <div class="mb-8">
              <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Drink Powder</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Sugar -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/sugar.jpg" alt="Sugar" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Sugar</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Powder -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/powder.jpg" alt="Powder" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Coconut Powder</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Tea Pack -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/green-tea-power.jpg" alt="green-tea-power"
                    class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Green Tea Powder</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Package -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/coca-powder.png" alt="coca-power" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Coca Powder</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
              </div>
            </div>
            <!-- Fast Food Section -->
            <div class="mb-8">
              <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Fast food</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Milk -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/Milk.jpg" alt="Milk" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Milk</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Noodle -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/noodles.jpg" alt="Noodle" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Noodles</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>

                <!-- Package -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/chocolate.jpg" alt="Chocolate" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Chocolate</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/nabati.jpg" alt="Nabati" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Nabati</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
              </div>
            </div>
            <!-- Syrups & Sauces -->
            <div class="mb-8">
              <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Syrups & Sauces</h3>
              <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Caramel Sauce -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/caramel-sauce.png" alt="caramel-sauce"
                    class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Caramel Sauce</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Syrups -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/Syrups.jpg" alt="Syrups" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Syrups</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Fruit Purees -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/Fruit Purees.jpg" alt="Fruit Purees"
                    class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Fruit Purees</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
                <!-- Honey -->
                <div class="bg-white rounded-lg shadow p-4">
                  <img src="../../Assets/images/honey.png" alt="Honey" class="w-full h-40 object-cover rounded-lg mb-4">
                  <h4 class="text-center font-medium mb-2">Honey</h4>
                  <button class="w-full px-4 py-2 text-sm text-gray-600 border rounded-full hover:bg-gray-50">View
                    more</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        </div>
        </div>
>>>>>>> 4e9b5b4c2ef93442db3c7deb023a72f78626809c
