<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }
        
        .header-image {
            width: 100%;
            height: 130px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        h1 {
            margin: 0;
            padding: 10px 0;
            font-size: 24px;
        }
        
        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .item-details {
            display: flex;
            align-items: center;
        }
        
        .item-image {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 50%;
        }
        
        .item-info h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }
        
        .item-info p {
            margin: 0;
            font-size: 12px;
            color: #666;
        }
        
        .item-controls {
            display: flex;
            align-items: center;
        }
        
        .quantity-control {
            margin-right: 10px;
        }
        
        select {
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .item-price {
            font-weight: bold;
            min-width: 60px;
            text-align: right;
        }
        
        .total-section {
            text-align: right;
            margin: 20px 0;
            font-weight: bold;
        }
        
        .form-section {
            margin: 30px 0;
        }
        
        .form-section h3 {
            margin-bottom: 15px;
            font-size: 16px;
            color: #555;
        }
        
        .form-row {
            display: flex;
            margin-bottom: 15px;
            gap: 15px;
        }
        
        .form-group {
            flex: 1;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        textarea {
            height: 100px;
            resize: vertical;
        }
        
        .payment-buttons {
            margin-top: 30px;
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }
        
        .btn-paypal {
            background-color: #ffc439;
            color: #000;
        }
        
        .btn-card {
            background-color: #333;
            color: white;
        }
        
        .powered-by {
            text-align: right;
            font-size: 12px;
            color: #999;
            margin-top: 10px;
        }
        
        .small-text {
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://i.pinimg.com/736x/bf/26/0a/bf260addea763484cb68b58213778a31.jpg" alt="Header Image" class="header-image">
        <h1>Order Details</h1>
    </div>
    
    <form id="order-form">
        <div class="menu-section">
            <h3>Products</h3>
            <div id="cartItems"></div>
        </div>
        
        <div class="total-section">
            <div>Total: <span id="total-price">$0.00</span></div>
        </div>
        
        <div class="form-section">
            <p class="small-text">Loading smart payment buttons...</p>
            
            <div class="pickup-details">
                <div class="form-group">
                    <label for="pickup-date">Pickup Date</label>
                    <input type="date" id="pickup-date" name="pickup-date" value="2025-04-06">
                </div>
                
                <div class="form-group" style="margin-top: 15px;">
                    <label for="pickup-time">Pickup Time</label>
                    <div style="display: flex; align-items: center;">
                        <select id="pickup-hour" name="pickup-hour" style="width: 70px;">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                        <span style="margin: 0 5px;">:</span>
                        <select id="pickup-minute" name="pickup-minute" style="width: 70px;">
                            <option value="00">00</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="45">45</option>
                        </select>
                        <select id="pickup-ampm" name="pickup-ampm" style="width: 70px; margin-left: 10px;">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                        </select>
                    </div>
                    <p class="small-text">Hour Minute</p>
                </div>
            </div>
            
            <div class="customer-info" style="margin-top: 20px;">
                <div class="form-row">
                    <div class="form-group">
                        <label for="first-name">Name</label>
                        <input type="text" id="first-name" name="first-name" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last-name"> </label>
                        <input type="text" id="last-name" name="last-name" placeholder="Last Name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="(000) 000-0000" required>
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 15px;">
                    <label for="notes">Additional Notes</label>
                    <textarea id="notes" name="notes"></textarea>
                </div>
            </div>
        </div>
        
        <div class="payment-buttons">
            <button type="submit" class="btn btn-paypal">PayPal Checkout</button>
            <button type="submit" class="btn btn-card">Debit or Credit Card</button>
            <div class="powered-by">Powered by PayPal</div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartItemsContainer = document.getElementById('cartItems');
            const totalPriceElement = document.getElementById('total-price');
            const orderForm = document.getElementById('order-form');

            function getCart() {
                const cart = localStorage.getItem('cart');
                return cart ? JSON.parse(cart) : [];
            }

            function saveCart(cart) {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function calculateTotal() {
                const cart = getCart();
                const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                totalPriceElement.textContent = '$' + total.toFixed(2);
            }

            function renderCart() {
                const cart = getCart();
                cartItemsContainer.innerHTML = '';

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
                    totalPriceElement.textContent = '$0.00';
                    return;
                }

                cart.forEach((item, index) => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'menu-item';
                    itemElement.innerHTML = `
                        <div class="item-details">
                            <img src="../Assets/images/uploads/${item.image}" alt="${item.name}" class="item-image">
                            <div class="item-info">
                                <h3>${item.name}</h3>
                                <p>Stock: ${item.stock}</p>
                            </div>
                        </div>
                        <div class="item-controls">
                            <div class="quantity-control">
                                <select name="quantity-${index}" id="quantity-${index}">
                                    ${[...Array(item.stock_quantity + 1).keys()].map(i => `<option value="${i}" ${i === item.quantity ? 'selected' : ''}>${i}</option>`).join('')}
                                </select>
                            </div>
                            <div class="size-control">
                                <select name="size-${index}" id="size-${index}">
                                    <option value="small">Small</option>
                                    <option value="medium">Medium</option>
                                    <option value="large">Large</option>
                                </select>
                            </div>
                        </div>
                        <div class="item-price">$${(item.price * item.quantity).toFixed(2)}</div>
                    `;

                    const quantitySelect = itemElement.querySelector(`#quantity-${index}`);
                    quantitySelect.addEventListener('change', function() {
                        const newQuantity = parseInt(this.value);
                        if (newQuantity === 0) {
                            cart.splice(index, 1);
                        } else {
                            cart[index].quantity = newQuantity;
                        }
                        saveCart(cart);
                        renderCart();
                        calculateTotal();
                    });

                    cartItemsContainer.appendChild(itemElement);
                });

                calculateTotal();
            }

            orderForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const cart = getCart();
                if (cart.length === 0) {
                    alert('Your cart is empty. Please add items to proceed.');
                    return;
                }

                const formData = new FormData(orderForm);
                const orderDetails = {
                    cart: cart,
                    pickup_date: formData.get('pickup-date'),
                    pickup_time: `${formData.get('pickup-hour')}:${formData.get('pickup-minute')} ${formData.get('pickup-ampm')}`,
                    customer: {
                        first_name: formData.get('first-name'),
                        last_name: formData.get('last-name'),
                        email: formData.get('email'),
                        phone: formData.get('phone'),
                        notes: formData.get('notes')
                    },
                    total: parseFloat(totalPriceElement.textContent.replace('$', ''))
                };

                // Here you would typically send the order to a server
                console.log('Order submitted:', orderDetails);

                // Clear the cart after successful order
                localStorage.removeItem('cart');
                alert('Order placed successfully!');
                window.location.href = '/path/to/confirmation/page'; // Redirect to a confirmation page
            });

            renderCart();
        });
    </script>
</body>
</html>