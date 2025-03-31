
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


    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll(".sidebar-link");
    
        links.forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add("bg-primary-100", "dark:bg-primary", "text-white");
            } else {
                link.classList.remove("bg-primary-100", "dark:bg-primary", "text-white");
            }
    
            link.addEventListener("click", function () {
                links.forEach(l => l.classList.remove("bg-primary-100", "dark:bg-primary", "text-white"));
                link.classList.add("bg-primary-100", "dark:bg-primary", "text-white");
            });
        });
    });
    