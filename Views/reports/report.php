<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 p-6">

    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">List of Products</h1>
        <div class="overflow-x-auto md:overflow-hidden">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead class="bg-gray-800 text-white hidden md:table-header-group">
                    <tr>
                        <th scope="col" class="py-2 px-4 text-left">Product Name</th>
                        <th scope="col" class="py-2 px-4 text-left">Export</th>
                        <th scope="col" class="py-2 px-4 text-left">Date</th>
                        <th scope="col" class="py-2 px-4 text-left">Type</th>
                        <th scope="col" class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100 md:table-row flex-col md:flex-row mb-4 md:mb-0 border-b border-gray-200">
                        <td class="py-2 px-4 md:table-cell flex items-center">
                            <span class="font-semibold w-24 md:hidden">Product Name:</span>
                            <div class="flex items-center space-x-2">
                                <img src="../../Assets/images/FX12 LOGO.png" alt="Product 1" class="w-8 h-8 rounded-full">
                                <span class="whitespace-nowrap">Coffee Brand</span>
                            </div>
                        </td>
                        <td class="py-2 px-4 md:table-cell flex items-center">
                            <span class="font-semibold w-24 md:hidden">Export:</span>
                            <span class="whitespace-nowrap">235</span>
                        </td>
                        <td class="py-2 px-4 md:table-cell flex items-center">
                            <span class="font-semibold w-24 md:hidden">Date:</span>
                            <span class="whitespace-nowrap">12/2/2025</span>
                        </td>
                        <td class="py-2 px-4 md:table-cell flex items-center">
                            <span class="font-semibold w-24 md:hidden">Type:</span>
                            <span class="inline-block bg-green-200 text-green-600 px-2 py-1 rounded-full text-sm font-semibold">Nut</span>
                        </td>
                        <td class="py-2 px-4 md:table-cell flex items-center md:justify-start">
                            <span class="font-semibold w-24 md:hidden">Action:</span>
                            <div class="flex space-x-2">
                                <a href="#" class="inline-block bg-blue-500 text-white hover:bg-blue-600 py-1 px-3 rounded-md text-sm">View</a>
                                <a href="#" class="inline-block bg-red-500 text-white hover:bg-red-600 py-1 px-3 rounded-md text-sm">Delete</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>