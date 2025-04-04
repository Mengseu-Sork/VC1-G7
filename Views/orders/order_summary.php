<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Review Order Summary</title>  
    <link rel="stylesheet" href="styles.css"> 
    <script src="https://cdn.tailwindcss.com"></script>
</head>  
<body>  

</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl">
        <h1 class="text-2xl font-bold mb-4 text-gray-700">Review Order Summary</h1>
        <p class="text-gray-600 mb-4">Please review your order and if all is correct, click "Place order".</p>

        <h2 class="text-xl font-semibold text-gray-600 mb-2">Order Details</h2>
        <table class="sm:w-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 p-1 text-left">Item</th>
                    <th class="border border-gray-300 p-1 text-center">Quantity</th>
                    <th class="border border-gray-300 p-1 text-right">Price</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border border-gray-200">
                    <td class="p-1">Product Name 1</td>
                    <td class="p-1 text-center">2</td>
                    <td class="p-1 text-right">$20.00</td>
                </tr>
                <tr class="border border-gray-300">
                    <td class="p-1">Product Name 2</td>
                    <td class="p-1 text-center">1</td>
                    <td class="p-1 text-right">$15.00</td>
                </tr>
                <tr class="border border-gray-300">
                    <td class="p-1">Product Name 3</td>
                    <td class="p-1 text-center">1</td>
                    <td class="p-1 text-right">$30.00</td>
                </tr>
            </tbody>
        </table>

        <h3 class="text-lg font-semibold mt-4 text-gray-700">Shipping Information</h3>
        <p class="text-gray-600">Shipping Address: 123 Example St, City, State, ZIP</p>
        <p class="text-gray-600">Shipping Method: Standard Shipping</p>

        <h3 class="text-lg font-semibold mt-4 text-gray-700">Order Totals</h3>
        <p class="text-gray-600">Subtotal: $65.00</p>
        <p class="text-gray-600">Shipping Cost: $5.00</p>
        <p class="text-lg font-bold text-gray-700">Total: $70.00</p>

        <div class="mt-6 flex space-x-3">
            <button class="bg-gray-400 text-white px-3 py-1  hover:bg-gray-600" onclick="editCart()">Edit Cart</button>
            <button class="bg-blue-400 text-white px-3 py-1  hover:bg-blue-600" onclick="editShipping()">Edit Shipping</button>
            <button class="bg-green-400 text-white px-3 py-1 hover:bg-green-600" onclick="finalizePayment()">Proceed to Payment</button>
        </div>
    </div>

    <script>
        function editCart() {
            alert('Redirecting to edit cart...');
        }

        function editShipping() {
            alert('Redirecting to edit shipping details...');
        }

        function finalizePayment() {
            alert('Proceeding to payment...');
        }
    </script>
</body>
</html>
