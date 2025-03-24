
    function filterByCategory() {
        let selectedCategory = document.getElementById("category-filter").value.toLowerCase();
        let rows = document.querySelectorAll(".product-list tbody tr");

        rows.forEach(row => {
            let category = row.querySelector("td:nth-child(4)").innerText.toLowerCase();
            if (selectedCategory === "" || category === selectedCategory) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
document.getElementById('search').addEventListener('click', function() {
        // Get the search query
        let searchQuery = document.getElementById('searchInput').value.toLowerCase();
        
        // Get all rows in the table (or the elements you want to search)
        const rows = document.querySelectorAll('#product-table-body tr');
        
        // Loop through each row
        rows.forEach(row => {
            // Get all text content in the row (for example, product name, price, etc.)
            const rowText = row.textContent.toLowerCase();
            
            // If the search query is found in the row text, display the row
            if (rowText.includes(searchQuery)) {
                row.style.display = '';  // Show the row
            } else {
                row.style.display = 'none';  // Hide the row
            }
        });
    });
    