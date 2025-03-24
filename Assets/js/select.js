
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

    