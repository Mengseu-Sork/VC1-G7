function showMoreProducts() {
    let hiddenProducts = document.querySelectorAll('.product-hidden');
    let counter = 0;

    hiddenProducts.forEach(product => {
        if (counter < (productsPerRow * rowsPerClick)) {
            product.classList.remove('hidden');
            product.classList.remove('product-hidden');
            counter++;
        }
    });

    shownProducts += counter;

    // Show "Back" button when "See More" is clicked
    document.getElementById('backButton').classList.remove('hidden');

    // Hide the "See More" button if all products are shown
    if (shownProducts >= totalProducts) {
        document.getElementById('seeMoreButton').style.display = 'none';
    }
}

function resetProducts() {
    let allProducts = document.querySelectorAll('.container .w-48.h-72');
    allProducts.forEach((product, index) => {
        if (index >= initialProductsToShow) {
            product.classList.add('hidden');
            product.classList.add('product-hidden');
        }
    });

    shownProducts = initialProductsToShow;

    // Show "See More" button again
    document.getElementById('seeMoreButton').style.display = 'block';

    // Hide "Back" button after resetting
    document.getElementById('backButton').classList.add('hidden');
}
