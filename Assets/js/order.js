
let orders = [];
let totalPrice = 0;

function filterProducts() {
    let input = document.getElementById('search').value.toLowerCase();
    let products = document.getElementsByClassName('product');
    
    for (let i = 0; i < products.length; i++) {
        let productName = products[i].getElementsByClassName('product-name')[0].innerText.toLowerCase();
        if (productName.includes(input)) {
            products[i].style.display = "block";
        } else {
            products[i].style.display = "none";
        }
    }
}

function addToOrder(button, price) {
    let productDiv = button.parentElement;
    let productName = productDiv.getElementsByClassName('product-name')[0].innerText;
    let quantity = parseInt(productDiv.getElementsByClassName('quantity')[0].value);
    let size = productDiv.getElementsByClassName('size')[0].value;
    let productImage = productDiv.getElementsByClassName('product-image')[0].src;
    
    let existingOrder = orders.find(order => order.name === productName && order.size === size);
    
    if (existingOrder) {
        existingOrder.quantity += quantity;
        existingOrder.price += price * quantity;
    } else {
        orders.push({ name: productName, quantity, size, image: productImage, price: price * quantity });
    }
    
    updateOrders();
}

function updateOrders() {
    let orderListDiv = document.getElementById('orderList');
    orderListDiv.innerHTML = '';
    totalPrice = 0;
    
    orders.forEach((order, index) => {
        totalPrice += order.price;
        let orderDiv = document.createElement('div');
        orderDiv.classList.add('order-item');
        orderDiv.innerHTML = `
            <img src="${order.image}" alt="${order.name}" class="order-image">
            <p>${order.name}</p>
            <input type="number" value="${order.quantity}" min="1" onchange="changeOrderQuantity(${index}, this.value)">
            <select onchange="changeOrderSize(${index}, this.value)">
                <option value="M" ${order.size === 'M' ? 'selected' : ''}>M</option>
                <option value="L" ${order.size === 'L' ? 'selected' : ''}>L</option>
                <option value="S" ${order.size === 'S' ? 'selected' : ''}>S</option>
            </select>
            <p>$${order.price.toFixed(2)}</p>
            <button class="remove-button" onclick="removeOrder(${index})">Remove</button>
        `;
        orderListDiv.appendChild(orderDiv);
    });
    
    document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
    document.getElementById('orderForm').style.display = 'block';
}

function changeOrderQuantity(index, newQuantity) {
    newQuantity = parseInt(newQuantity);
    let order = orders[index];
    order.price = (order.price / order.quantity) * newQuantity;
    order.quantity = newQuantity;
    updateOrders();
}

function changeOrderSize(index, newSize) {
    orders[index].size = newSize;
    updateOrders();
}

function removeOrder(index) {
    orders.splice(index, 1);
    updateOrders();
}

function submitOrder() {
    alert('Order Submitted: ' + JSON.stringify(orders) + '\nTotal Price: $' + totalPrice.toFixed(2));
    orders = [];
    totalPrice = 0;
    closeOrderForm();
}

function closeOrderForm() {
    document.getElementById('orderForm').style.display = 'none';
}