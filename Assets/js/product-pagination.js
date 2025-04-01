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
  
  