<?php
// Assuming this is your create.php file (in Views/pages/create.php)
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Add a New Product</h1>

        <form action="/product/store" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Product Name:</label>
                <input type="text" name="name" id="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" />
            </div>

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                <input type="number" name="price" id="price" step="0.01" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" />
            </div>

            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type:</label>
                <select name="type" id="type" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500">
                    <option value="drinks">Drinks</option>
                    <option value="food">Food</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="date_start" class="block text-sm font-medium text-gray-700">Date Start:</label>
                <input type="date" name="date_start" id="date_start" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" />
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Product Image:</label>
                <input type="file" name="image" id="image" accept="image/*" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500" />
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-500"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 transition">Add Product</button>
        </form>
    </div>

</body>

</html>