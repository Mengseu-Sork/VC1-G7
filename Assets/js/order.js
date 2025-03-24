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