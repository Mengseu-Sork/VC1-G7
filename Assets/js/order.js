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

document.getElementById("placeOrderBtn").addEventListener("click", function() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    fetch("Router.php?route=placeOrder", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            user_id: 1, // Replace with logged-in user ID
            cart: cart
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Order placed successfully! Order ID: " + data.order_id);
            localStorage.removeItem("cart"); // Clear cart after order
        } else {
            alert("Order failed. Try again.");
        }
    })
    .catch(error => console.error("Error:", error));
});

document.addEventListener("DOMContentLoaded", () => {
    const orderForm = document.getElementById("order-form")
    const cancelBtn = document.getElementById("cancelBtn")
    const totalPriceElement = document.getElementById("total-price")
    const firstNameInput = document.getElementById("first_name")
    const lastNameInput = document.getElementById("last_name")
  
    function getCart() {
      return JSON.parse(localStorage.getItem("cart") || "[]")
    }
  
    function saveCart(cart) {
      localStorage.setItem("cart", JSON.stringify(cart))
    }
  
    function calculateTotal() {
      const total = getCart().reduce((sum, item) => sum + item.price * item.quantity, 0)
      totalPriceElement.textContent = "$" + total.toFixed(2)
      return total
    }
  
    function renderCart() {
      const cart = getCart()
      const cartItemsContainer = document.getElementById("cartItems")
      cartItemsContainer.innerHTML = ""
  
      if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p class="text-sm text-gray-500">Your cart is empty.</p>'
        totalPriceElement.textContent = "$0.00"
        return
      }
  
      cart.forEach((item, index) => {
        const itemDiv = document.createElement("div")
        itemDiv.className = "flex items-center justify-between border-b pb-4"
        itemDiv.innerHTML = `
          <div class="flex items-center">
            <img src="../../Assets/images/uploads/${item.image}" alt="${item.name}" class="w-12 h-12 rounded-full mr-4" />
            <div>
              <h3 class="font-semibold">${item.name}</h3>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <div class="flex items-center border rounded px-2 py-1 space-x-2">
              <button type="button" data-index="${index}" class="decreaseQty text-xl font-bold text-gray-600 hover:text-black">−</button>
              <input type="text" id="quantity-${index}" value="${item.quantity}" readonly class="w-8 text-center bg-transparent border-none focus:outline-none" />
              <button type="button" data-index="${index}" class="increaseQty text-xl font-bold text-gray-600 hover:text-black">+</button>
            </div>
          </div>
          <div class="text-right font-medium w-20">$${(item.price * item.quantity).toFixed(2)}</div>
        `
  
        itemDiv.querySelector(".increaseQty").addEventListener("click", function () {
          const idx = Number.parseInt(this.getAttribute("data-index"))
          cart[idx].quantity++
          saveCart(cart)
          renderCart()
        })
  
        itemDiv.querySelector(".decreaseQty").addEventListener("click", function () {
          const idx = Number.parseInt(this.getAttribute("data-index"))
          if (cart[idx].quantity > 1) {
            cart[idx].quantity--
            saveCart(cart)
            renderCart()
          }
        })
  
        cartItemsContainer.appendChild(itemDiv)
      })
  
      calculateTotal()
    }
  
    orderForm.addEventListener("submit", (e) => {
      e.preventDefault()
      const cart = getCart()
      if (cart.length === 0) {
        alert("Your cart is empty.")
        return
      }
  
      // Validate names
      const firstName = firstNameInput.value.trim()
      const lastName = lastNameInput.value.trim()
      const nameRegex = /^[a-zA-Z\s-]+$/
      if (!firstName || !lastName) {
        alert("First name and last name are required.")
        return
      }
      if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
        alert("Names can only contain letters, spaces, or hyphens.")
        return
      }
  
      const formData = new FormData(orderForm)
      const pickupTime = `${formData.get("pickup_hour")}:${formData.get("pickup_minute")} ${formData.get("pickup_ampm")}`
  
      // Format cart items to match what the server expects
      const products = cart.map((item) => ({
        product_id: item.id,
        quantity: item.quantity,
        subtotal: item.price * item.quantity,
      }))
  
      const orderDetails = {
        products: products,
        total_amount: calculateTotal(),
        customer: {
          first_name: firstName,
          last_name: lastName,
          email: formData.get("email"),
          phone: formData.get("phone"),
        },
        pickup_date: formData.get("pickup_date"),
        pickup_time: pickupTime,
      }
  
      console.log("Sending order data:", orderDetails)
  
      fetch("/order/process", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(orderDetails),
      })
        .then((response) => {
          if (!response.ok) {
            return response.text().then((text) => {
              throw new Error(`HTTP error! Status: ${response.status} - ${text}`)
            })
          }
          return response.json()
        })
        .then((data) => {
          console.log("Order response:", data)
          if (data.success) {
            alert("Order placed successfully!")
            localStorage.removeItem("cart")
            window.location.href = "/pages/products"
          } else {
            alert("Error: " + data.message)
          }
        })
        .catch((error) => {
          console.error("Fetch error:", error)
          alert("An error occurred while placing the order: " + error.message)
        })
    })
  
    cancelBtn.addEventListener("click", () => {
      localStorage.removeItem("cart")
      window.location.href = "/pages/products"
    })
  
    renderCart()
  })
  
// Analyzing the database schema and PHP code to identify the issue

console.log("COFFEE SHOP ORDER SYSTEM - ISSUE ANALYSIS");
console.log("------------------------------------------");

// Database schema shows:
console.log("Database Table: 'order_detail'");
console.log("Columns: order_detail_id, order_id, product_id, quantity, subtotal");
console.log("");

// But the OrderModel.php is trying to insert into:
console.log("PHP Code is trying to insert into: 'order_items'");
console.log("With fields: order_id, product_id, quantity, subtotal");
console.log("");

console.log("ISSUE IDENTIFIED:");
console.log("Table name mismatch in OrderModel.php - using 'order_items' instead of 'order_detail'");
console.log("");

console.log("SOLUTION:");
console.log("Modify the OrderModel.php file to use the correct table name 'order_detail' instead of 'order_items'");
console.log("");

console.log("Code to change:");
console.log("FROM:");
console.log("$itemStmt = $pdo->query(\"");
console.log("    INSERT INTO order_items (order_id, product_id, quantity, subtotal) ");
console.log("    VALUES (?, ?, ?, ?)");
console.log("\");");
console.log("");

console.log("TO:");
console.log("$itemStmt = $pdo->query(\"");
console.log("    INSERT INTO order_detail (order_id, product_id, quantity, subtotal) ");
console.log("    VALUES (?, ?, ?, ?)");
console.log("\");");
