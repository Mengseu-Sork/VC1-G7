let orderList = [];

function addToOrder(productName, price, image) {
    let qty = parseInt(document.getElementById('qty_' + productName).value);
    let size = document.getElementById('size_' + productName).value;
    let itemPrice = parseFloat(price.replace('$', ''));

    let existingItem = orderList.find(item => item.name === productName && item.size === size);
    if (existingItem) {
        existingItem.quantity += qty;
    } else {
        let item = { 
            name: productName, 
            price: itemPrice, 
            quantity: qty, 
            size: size, 
            image: image
        };
        orderList.push(item);
    }

    updateOrderList();
}

function updateOrderList() {
    let listContainer = document.getElementById('orderList');
    let total = 0;
    listContainer.innerHTML = "";
    
    listContainer.style.maxHeight = "250px"; // Set max height for two items
    listContainer.style.overflowY = "auto"; // Enable scrolling

    orderList.forEach((item, index) => {
        total += item.price * item.quantity;
        listContainer.innerHTML += `
            <div class="order-item">
                <img src="${item.image}" alt="${item.name}" class="order-image">
                <div class="order-details">
                    <p>${item.name} (${item.size}) - $${(item.price * item.quantity).toFixed(2)}</p>
                    <label>Quantity:</label>
                    <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)">
                    <label>Size:</label>
                    <select onchange="updateSize(${index}, this.value)">
                        <option value="S" ${item.size === 'S' ? 'selected' : ''}>S</option>
                        <option value="M" ${item.size === 'M' ? 'selected' : ''}>M</option>
                        <option value="L" ${item.size === 'L' ? 'selected' : ''}>L</option>
                    </select>
                    <button class="remove-btn" onclick="removeFromOrder(${index})">Remove</button>
                </div>
            </div>
        `;
    });

    document.getElementById('totalPrice').innerText = total.toFixed(2);
    document.getElementById('orderForm').style.display = "block";
}

function updateQuantity(index, newQuantity) {
    orderList[index].quantity = parseInt(newQuantity);
    updateOrderList();
}

function updateSize(index, newSize) {
    let item = orderList[index];
    let duplicateItem = orderList.find(i => i.name === item.name && i.size === newSize);
    
    if (duplicateItem) {
        duplicateItem.quantity += item.quantity;
        orderList.splice(index, 1);
    } else {
        item.size = newSize;
    }

    updateOrderList();
}

function removeFromOrder(index) {
    orderList.splice(index, 1);
    updateOrderList();
}

function closeOrderForm() {
    document.getElementById('orderForm').style.display = "none";
}

function submitOrder() {
    if (orderList.length === 0) {
        alert("Your order is empty!");
        return;
    }

    alert("Order submitted successfully!");
    orderList = [];
    updateOrderList();
    closeOrderForm();
}
