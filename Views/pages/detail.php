<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Stock Details</title>
    <style>
        .quantity-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            color: white;
            margin-left: 8px;
        }
        .low-stock {
            background-color: #D32F2F; /* Red for < 10 */
        }
        .medium-stock {
            background-color: #6F4F37; /* Coffee for 10-50 */
        }
        .high-stock {
            background-color: #1976D2; /* Blue for 51-100 */
        }
    </style>
</head>
<body>
    <div class="bg-gray-200 p-6">
        <h1 class="text-2xl font-bold mb-6">Stock Details</h1>
        <?php if (!empty($stock) && is_array($stock)) : ?>
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Quantity</th>
                        <th class="py-3 px-6 text-left">Last Update</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="py-3 px-6"><?php echo htmlspecialchars($stock['product_name']); ?></td>
                        <td class="py-3 px-6 quantity-cell"><?php echo htmlspecialchars($stock['quantity']); ?></td>
                        <td class="py-3 px-6"><?php echo htmlspecialchars($stock['last_updated']); ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-6">
                <a href="/pages/stock" class="ml-2 bg-red-400 text-white py-2 px-4 rounded hover:bg-red-500">Back</a>
            </div>
        <?php else : ?>
            <p class="text-red-500">Stock not found.</p>
        <?php endif; ?>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let quantityCells = document.querySelectorAll(".quantity-cell");

            quantityCells.forEach(quantityCell => {
                let quantity = parseInt(quantityCell.textContent.trim());

                if (!isNaN(quantity)) {
                    let badgeClass;
                    if (quantity < 10) {
                        badgeClass = "low-stock";
                    } else if (quantity >= 10 && quantity <= 50) {
                        badgeClass = "medium-stock";
                    } else if (quantity > 50 && quantity <= 100) {
                        badgeClass = "high-stock";
                    } else {
                        badgeClass = ""; // No color for > 100
                    }

                    quantityCell.innerHTML = `<span class="quantity-badge ${badgeClass}">${quantity}</span>`;

                    if (quantity < 10 && !window.stockLowAlert) {
                        window.stockLowAlert = true;
                        alert("Warning: Stock is low! (Less than 10 items left)");
                    }
                }
            });
        });
    </script>

</body>
</html>