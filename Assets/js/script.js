
function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let table = document.getElementById("productsTable");
    let rows = table.getElementsByTagName("tr");

    console.log("Search Input: ", input);

    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName("td");

        if (cells.length > 0) {

            let name = cells[0].innerText.toLowerCase().trim(); 
            let price = cells[1].innerText.toLowerCase().trim();
            let category = cells[2].innerText.toLowerCase().trim();

            console.log(`Row ${i} - Name: ${name}, Price: ${price}, Category: ${category}`);

            if (name.includes(input) || price.includes(input) || category.includes(input)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }

    if (input === "") {
        for (let i = 1; i < rows.length; i++) {
            rows[i].style.display = "";
        }
    }
}
