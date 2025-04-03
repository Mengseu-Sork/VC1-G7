 <div class="bg-gray-200 p-6">
     <h1 class="text-2xl font-bold mb-6">Products in Stock</h1>
     <div class="flex justify-between flex-col md:flex-row items-center gap-4 mb-6">
         <a href="/pages/create">
             <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">Add Product</button>
         </a>
         <div class="flex w-full md:w-auto gap-2 relative">
             <input type="text" id="searchInput" placeholder="Search products..." required
                 class="w-full md:w-64 px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 outline-none bg-white dark:bg-darker border-b dark:border-primary-darker"
                 oninput="searchProducts()">
             <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
             <button type="button" onclick="searchProducts()"
                 class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                 Search
             </button>
         </div>
     </div>
     <div class="grid grid-cols-3 gap-4">
         <?php if (!empty($stocks)) : ?>
             <?php foreach ($stocks as $stock) : ?>
                 <div class="bg-white rounded-lg shadow-lg p-4 text-center">
                     <h2 class="text-lg font-semibold"><?php echo $stock['product_name']; ?></h2>
                     <p class="text-md font-bold mt-1">Quantity: <?php echo $stock['quantity']; ?></p>
                     <a href="/pages/detail?id=<?php echo urlencode($stock['id']); ?>"
                         class="mt-2 inline-block bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 transition">
                         View Details
                     </a>
                 </div>
             <?php endforeach; ?>
         <?php else : ?>
             <p class="text-red-500">No products available.</p>
         <?php endif; ?>
     </div>
 </div>