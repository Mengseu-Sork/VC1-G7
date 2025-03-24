function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let productContainer = document.getElementById("productContainer");
    let products = productContainer.getElementsByClassName("w-48");

    // Loop through each product and check if it matches the search input
    for (let product of products) {
        let name = product.getAttribute("data-name").toLowerCase();
        let price = product.getAttribute("data-price").toLowerCase();

        // Check if the search input matches the product's name, category, or price
        if (name.includes(input) || price.includes(input)) {
            product.style.display = ""; // Show the product if it matches the search
        } else {
            product.style.display = "none"; // Hide the product if it does not match
        }
    }
}
function filterByCategory(category) {
        const rows = document.querySelectorAll("#product-table-body tr");
        rows.forEach(row => {
            const productCategory = row.getAttribute("data-category").toLowerCase();
            if (category === "" || productCategory === category.toLowerCase()) {
                row.style.display = ""; // Show the row
            } else {
                row.style.display = "none"; // Hide the row
            }
        });
    }

    // Open modal for deletion
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    // Close modal for deletion
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

// document.addEventListener("DOMContentLoaded", function () {
//     const selectAllCheckbox = document.getElementById("selectAll");
//     const productCheckboxes = document.querySelectorAll(".productCheckbox");

//     // Create add stock button dynamically
//     const addStockButton = document.createElement("button");
//     addStockButton.id = "addStockButton";
//     addStockButton.textContent = "Add Stock";
//     addStockButton.classList.add(
//         "bg-blue-500", "hover:bg-blue-600", "text-white",
//         "font-semibold", "py-2", "px-4", "rounded-lg",
//         "shadow-md", "transition", "duration-300", "hidden", "mt-4", "mb-4", "ml-2"
//     );
//     addStockButton.addEventListener("click", addStockToSelectedProducts);

//     // Find the table's parent container and append buttons after it
//     const tableContainer = document.getElementById("productsTable").parentElement;
//     tableContainer.appendChild(addStockButton);

//     // Function to toggle button visibility
//     function toggleButtons() {
//         const anyChecked = Array.from(productCheckboxes).some(checkbox => checkbox.checked);
//         addStockButton.classList.toggle("hidden", !anyChecked);
//     }

//     // Listen for changes on individual checkboxes
//     productCheckboxes.forEach(checkbox => {
//         checkbox.addEventListener("change", toggleButtons);
//     });

//     // Handle "Select All" checkbox
//     selectAllCheckbox.addEventListener("change", function () {
//         productCheckboxes.forEach(checkbox => {
//             checkbox.checked = selectAllCheckbox.checked;
//         });
//         toggleButtons();
//     });

//     // Function to add stock to selected products
//     function addStockToSelectedProducts() {
//         const selectedIds = Array.from(productCheckboxes)
//             .filter(checkbox => checkbox.checked)
//             .map(checkbox => checkbox.closest("tr").dataset.productId);

//         if (selectedIds.length === 0) return;
//         if (!confirm("Are you sure you want to add stock to the selected products?")) return;

//         fetch('/products/add-stock-multiple', {
//             method: 'POST',
//             headers: { 'Content-Type': 'application/json' },
//             body: JSON.stringify({ ids: selectedIds })
//         }).then(response => response.json())
//           .then(data => {
//               if (data.success) {
//                   alert("Stock added successfully!");
//               } else {
//                   alert("Failed to add stock.");
//               }
//           }).catch(error => console.error("Error:", error));
//     }
// });