// Product pagination functionality
document.addEventListener("DOMContentLoaded", () => {
    // Variables are defined in the PHP file:
    // productsPerRow, rowsPerClick, initialProductsToShow, shownProducts, totalProducts
  
    // Declare variables if they are not already declared
    var productsPerRow = typeof productsPerRow !== "undefined" ? productsPerRow : 3 // Default value
    var rowsPerClick = typeof rowsPerClick !== "undefined" ? rowsPerClick : 1 // Default value
    var initialProductsToShow = typeof initialProductsToShow !== "undefined" ? initialProductsToShow : 6 // Default value
    var shownProducts = typeof shownProducts !== "undefined" ? shownProducts : initialProductsToShow // Default value
    var totalProducts =
      typeof totalProducts !== "undefined" ? totalProducts : document.querySelectorAll("#productContainer > div").length // Default value
  
    updateButtonVisibility()
  
    // Make sure the functions are available globally
    window.showMoreProducts = showMoreProducts
    window.resetProducts = resetProducts
    window.filterByCategory = filterByCategory
  })
  
  // Show more products when "See More" is clicked
  function showMoreProducts() {
    const hiddenProducts = document.querySelectorAll(".product-hidden")
    const productsToShow = Math.min(productsPerRow * rowsPerClick, hiddenProducts.length)
  
    // Show the next batch of products
    for (let i = 0; i < productsToShow; i++) {
      hiddenProducts[i].classList.remove("hidden", "product-hidden")
    }
  
    // Update the count of shown products
    shownProducts += productsToShow
  
    // Update button visibility
    updateButtonVisibility()
  }
  
  // Reset to initial view when "Back" is clicked
  function resetProducts() {
    const allProducts = document.querySelectorAll("#productContainer > div")
  
    // Hide products beyond the initial count
    allProducts.forEach((product, index) => {
      if (index >= initialProductsToShow) {
        product.classList.add("hidden", "product-hidden")
      }
    })
  
    // Reset the count of shown products
    shownProducts = initialProductsToShow
  
    // Update button visibility
    updateButtonVisibility()
  }
  
  // Update the visibility of See More and Back buttons
  function updateButtonVisibility() {
    const seeMoreButton = document.getElementById("seeMoreButton")
    const backButton = document.getElementById("backButton")
  
    // Show "See More" button only if there are more products to show
    if (shownProducts < totalProducts) {
      seeMoreButton.classList.remove("hidden")
    } else {
      seeMoreButton.classList.add("hidden")
    }
  
    // Show "Back" button only if we're showing more than the initial count
    if (shownProducts > initialProductsToShow) {
      backButton.classList.remove("hidden")
    } else {
      backButton.classList.add("hidden")
    }
  }
  
  // Filter products by category
  function filterByCategory(category) {
    const products = document.querySelectorAll("#productContainer > div")
    let visibleCount = 0
  
    products.forEach((product) => {
      const productCategory = product.getAttribute("data-category")
  
      // If "All Products" is selected or categories match
      if (category === "#" || productCategory === category) {
        // Show based on pagination rules
        if (visibleCount < shownProducts) {
          product.classList.remove("hidden")
          product.classList.remove("product-hidden")
          visibleCount++
        } else {
          product.classList.add("hidden")
          product.classList.add("product-hidden")
        }
      } else {
        // Hide if category doesn't match
        product.classList.add("hidden")
      }
    })
  
    // Update buttons after filtering
    updateButtonVisibility()
  }
  
  function filterByCategory(category) {
    const productCards = document.querySelectorAll("#productContainer div[data-category]");
    productCards.forEach(card => {
        const productCategory = card.getAttribute("data-category").toLowerCase();
        if (!category || productCategory === category.toLowerCase()) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
}

function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let productContainer = document.getElementById("productContainer");
    let products = productContainer.getElementsByClassName("w-48");
    for (let product of products) {
        let name = product.getAttribute("data-name").toLowerCase();
        let price = product.getAttribute("data-price").toLowerCase();
        if (name.includes(input) || price.includes(input)) {
            product.style.display = "";
        } else {
            product.style.display = "none";
        }
    }
    if (input === "") {
        for (let product of products) {
            product.style.display = "";
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('orderModal');
    const modalImage = document.getElementById('modalProductImage');
    const modalPrice = document.getElementById('modalProductPrice');
    const modalStockStatus = document.getElementById('modalStockStatus');
    const modalProductNameDisplay = document.getElementById('modalProductNameDisplay');
    const quantityInput = document.getElementById('quantity');
    const totalPriceSpan = document.getElementById('totalPrice');
    const cancelBtn = document.getElementById('cancelBtn');
    const orderBtn = document.getElementById('orderBtn');
    const modalProductName = document.getElementById('modalProductName');
    const modalPriceInput = document.getElementById('modalPrice');
    const orderForm = document.getElementById('orderForm');
    const successMessage = document.getElementById('successMessage');
    const closeSuccess = document.getElementById('closeSuccess');
    const increaseQty = document.getElementById("increaseQty");
    const decreaseQty = document.getElementById("decreaseQty");

    let currentPrice = 0;
    let currentStock = '';
    let currentStockQuantity = 0;

    function updateTotalPrice() {
        const quantity = parseInt(quantityInput.value) || 1;
        totalPriceSpan.textContent = (currentPrice * quantity).toFixed(2);
    }

    document.querySelectorAll('.show-order-modal').forEach(button => {
        button.addEventListener('click', function () {
            const productName = this.getAttribute('data-product-name');
            const productImage = this.getAttribute('data-product-image');
            currentPrice = parseFloat(this.getAttribute('data-product-price')) || 0;
            currentStock = this.getAttribute('data-stock');
            currentStockQuantity = parseInt(this.getAttribute('data-stock-quantity')) || 0;

            modalProductName.value = productName;
            modalPriceInput.value = currentPrice;
            modalImage.src = `../Assets/images/uploads/${productImage}`;
            modalImage.classList.remove('hidden');
            modalPrice.textContent = `$${currentPrice.toFixed(2)}`;
            modalStockStatus.textContent = currentStock;
            modalStockStatus.className = `text-lg font-semibold mb-2 ${currentStock === 'In stock' ? 'text-green-600' : 'text-red-600'}`;
            modalProductNameDisplay.textContent = productName; // Populate product name in modal
            quantityInput.value = 1;
            updateTotalPrice();

            orderBtn.disabled = currentStock !== 'In stock';
            orderBtn.classList.toggle('bg-gray-400', currentStock !== 'In stock');
            orderBtn.classList.toggle('bg-blue-500', currentStock === 'In stock');
            modal.classList.remove('hidden');
        });
    });

    quantityInput.addEventListener("input", function () {
        let quantity = parseInt(quantityInput.value) || 1;
        if (quantity < 1) quantity = 1;
        if (currentStockQuantity > 0 && quantity > currentStockQuantity) quantity = currentStockQuantity;
        quantityInput.value = quantity;
        updateTotalPrice();
    });

    increaseQty.addEventListener("click", function () {
        let quantity = parseInt(quantityInput.value) || 1;
        if (currentStockQuantity > 0 && quantity >= currentStockQuantity) return;
        quantityInput.value = quantity + 1;
        updateTotalPrice();
    });

    decreaseQty.addEventListener("click", function () {
        let quantity = parseInt(quantityInput.value) || 1;
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
            updateTotalPrice();
        }
    });

    cancelBtn.addEventListener('click', function () {
        modal.classList.add('hidden');
        modalImage.classList.add('hidden');
    });

    orderForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const quantity = parseInt(quantityInput.value) || 1;

        if (currentStock !== 'In stock') {
            alert('Cannot order: Product is out of stock.');
            return;
        }
        if (quantity <= 0) {
            alert('Please enter a valid quantity greater than 0.');
            return;
        }
        if (currentStockQuantity > 0 && quantity > currentStockQuantity) {
            alert(`Cannot order: Only ${currentStockQuantity} items left in stock.`);
            return;
        }

        modal.classList.add('hidden');
        successMessage.classList.remove('hidden');
    });

    closeSuccess.addEventListener('click', function () {
        successMessage.classList.add('hidden');
    });
});