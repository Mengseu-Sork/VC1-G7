function searchProducts() {
    let input = document.getElementById("searchInput").value.toLowerCase().trim();
    let table = document.getElementById("productsTable");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].getElementsByTagName("td");

        if (cells.length > 0) {
            let name = cells[2].innerText.toLowerCase().trim();
            let price = cells[3].innerText.toLowerCase().trim(); 
            let category = cells[5].innerText.toLowerCase().trim(); 


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

// Update stock status for a single product
function updateStockStatus(selectElement) {
    const productId = selectElement.getAttribute('data-id');
    const stockStatus = selectElement.value;
    
    console.log('Updating product ID:', productId, 'to stock status:', stockStatus);
    
    fetch('/products/update-stock', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${productId}&stock_status=${stockStatus}`
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Show success notification
            alert('Stock status updated successfully');
        } else {
            alert('Failed to update stock status: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating stock status: ' + error.message);
    });
}

// Filter products by category
function filterByCategory(category) {
    const rows = document.querySelectorAll("#product-table-body tr");
    rows.forEach(row => {
        const productCategory = row.getAttribute("data-category").toLowerCase();
        if (category === "" || productCategory === category.toLowerCase()) {
            row.style.display = ""; 
        } else {
            row.style.display = "none";
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

// Open stock status modal
function showStockModal() {
    document.getElementById('stockStatusModal').classList.remove('hidden');
}

// Close stock status modal
function closeStockModal() {
    document.getElementById('stockStatusModal').classList.add('hidden');
}

// Update bulk stock status
function updateBulkStockStatus() {
    const selectedIds = Array.from(document.querySelectorAll('.productCheckbox:checked'))
        .map(checkbox => checkbox.getAttribute('data-id'));
    
    if (selectedIds.length === 0) {
        alert('Please select at least one product');
        return;
    }
    
    const stockStatus = document.getElementById('bulkStockStatus').value;
    
    // For debugging
    console.log('Selected IDs:', selectedIds);
    console.log('Stock Status:', stockStatus);
    
    fetch('/products/update-bulk-stock', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `ids=${JSON.stringify(selectedIds)}&stock_status=${stockStatus}`
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Update UI to reflect changes
            selectedIds.forEach(id => {
                const select = document.querySelector(`.stock-status-select[data-id="${id}"]`);
                if (select) {
                    select.value = stockStatus;
                }
            });
            
            closeStockModal();
            alert('Stock status updated successfully for selected products');
        } else {
            alert('Failed to update stock status: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating stock status: ' + error.message);
    });
}

//Add Stock
document.addEventListener("DOMContentLoaded", function () {
    const selectAllCheckbox = document.getElementById("selectAll");
    const productCheckboxes = document.querySelectorAll(".productCheckbox");

    // Create "Update Stock Status" button dynamically
    const updateStockButton = document.createElement("button");
    updateStockButton.id = "updateStockButton";
    updateStockButton.textContent = "Update Stock Status";
    updateStockButton.classList.add(
        "bg-blue-500", "hover:bg-blue-600", "text-white",
        "font-semibold", "py-2", "px-4", "rounded-lg",
        "shadow-md", "transition", "duration-300", "hidden", "mt-4", "mb-4", "ml-4"
    );
    updateStockButton.addEventListener("click", showStockModal);

    // Create "Clear All" button dynamically
    const clearAllButton = document.createElement("button");
    clearAllButton.id = "clearAllButton";
    clearAllButton.textContent = "Clear All";
    clearAllButton.classList.add(
        "bg-red-500", "hover:bg-red-600", "text-white",
        "font-semibold", "py-2", "px-4", "rounded-lg",
        "shadow-md", "transition", "duration-300", "hidden", "mt-4", "mb-4", "ml-4"
    );
    clearAllButton.addEventListener("click", clearAllSelections);

    // Find the table's parent container and append buttons after it
    const tableContainer = document.getElementById("productsTable").parentElement;
    tableContainer.appendChild(updateStockButton);
    tableContainer.appendChild(clearAllButton);

    // Function to toggle button visibility
    function toggleButtons() {
        const anyChecked = Array.from(productCheckboxes).some(checkbox => checkbox.checked);
        updateStockButton.classList.toggle("hidden", !anyChecked);
        clearAllButton.classList.toggle("hidden", !anyChecked);
    }

    // Listen for changes on individual checkboxes
    productCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", toggleButtons);
    });

    // Handle "Select All" checkbox
    selectAllCheckbox.addEventListener("change", function () {
        productCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });
        toggleButtons();
    });

    // Function to clear all selected checkboxes
    function clearAllSelections() {
        selectAllCheckbox.checked = false; // Uncheck "Select All"
        productCheckboxes.forEach(checkbox => {
            checkbox.checked = false; // Uncheck all checkboxes
        });
        toggleButtons();
    }

    // Toggle buttons based on initial state of checkboxes
    toggleButtons();
});
