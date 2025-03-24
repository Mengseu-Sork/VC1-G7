function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let table = document.getElementById("productsTable");
    let rows = table.getElementsByTagName("tr");

    console.log("Search Input: ", input); // Debugging input value

    // Loop through all rows (starting from index 1 to skip the header row)
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName("td");

        if (cells.length > 0) {
            let name = cells[0].innerText.toLowerCase().trim(); // Assuming the name is in the first column
            let price = cells[1].innerText.toLowerCase().trim(); // Assuming price is in the second column

            console.log(`Row ${i} - Name: ${name}, Price: ${price}`); // Debugging row content

            // Check if the search input matches the product name or price
            if (name.includes(input) || price.includes(input)) {
                rows[i].style.display = ""; // Show the row if it matches the search
            } else {
                rows[i].style.display = "none"; // Hide the row if it doesn't match
            }
        }
    }

    // If input is empty, show all rows
    if (input === "") {
        for (let i = 1; i < rows.length; i++) {
            rows[i].style.display = ""; // Show all rows if input is empty
        }
    }
}
