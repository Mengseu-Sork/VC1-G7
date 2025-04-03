<?php
?>
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
        <img src="https://i.pinimg.com/736x/bf/26/0a/bf260addea763484cb68b58213778a31.jpg" alt="Pizza" class="header-image">
        <h1>Order Details</h1>
    </div>
    
    <form id="pizza-order-form">
        <div class="menu-section">
            <h3>Products</h3>
            
            <div class="menu-item">
                <div class="item-details">
                    <img src="https://i.pinimg.com/736x/86/84/06/868406451e66c13b92c2c77ea70b009f.jpg" alt="Pizza Neapolitan" class="item-image">
                    <div class="item-info">
                        <h3>Cozy Abibio Arabica Coffee</h3>
                        <p>Ingredients will be written here.</p>
                    </div>
                </div>
                <div class="item-controls">
                    <div class="quantity-control">
                        <select name="neapolitan-quantity" id="neapolitan-quantity">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="size-control">
                        <select name="neapolitan-size" id="neapolitan-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>
                </div>
                <div class="item-price">$10.50</div>
            </div>
            
            <div class="menu-item">
                <div class="item-details">
                    <img src="https://i.pinimg.com/736x/64/2b/7b/642b7b301d5da89c3118396a4660d2ac.jpg" alt="Grounds Coffee" class="item-image">
                    <div class="item-info">
                        <h3>Grounds Coffee</h3>
                        <p>Ingredients will be written here.</p>
                    </div>
                </div>
                <div class="item-controls">
                    <div class="quantity-control">
                        <select name="pepperoni-quantity" id="pepperoni-quantity">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="size-control">
                        <select name="pepperoni-size" id="pepperoni-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>
                </div>
                <div class="item-price">$13.00</div>
            </div>
        </div>
        
        <div class="total-section">
            <div>Total: <span id="total-price">$0.00</span></div>
        </div>
        
        <div class="form-section">
            <p class="small-text">loading smart payment buttons...</p>
            
            <div class="pickup-details">
                <div class="form-group">
                    <label for="pickup-date">Pickup Date</label>
                    <input type="date" id="pickup-date" name="pickup-date" value="2024-03-04">
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
                        <input type="text" id="first-name" name="first-name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="last-name">&nbsp;</label>
                        <input type="text" id="last-name" name="last-name" placeholder="Last Name">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="example@example.com">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="(000) 000-0000">
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 15px;">
                    <label for="notes">Additional Notes</label>
                    <textarea id="notes" name="notes"></textarea>
                </div>
            </div>
        </div>
        
        <div class="payment-buttons">
            <button type="button" class="btn btn-paypal">PayPal Checkout</button>
            <button type="button" class="btn btn-card">Debit or Credit Card</button>
            <div class="powered-by">Powered by PayPal</div>
        </div>
    </form>

    <script>
        // Simple JavaScript to calculate the total
        document.addEventListener('DOMContentLoaded', function() {
            const neapolitanQuantity = document.getElementById('neapolitan-quantity');
            const pepperoniQuantity = document.getElementById('pepperoni-quantity');
            const totalPrice = document.getElementById('total-price');
            
            function calculateTotal() {
                const neapolitanPrice = 10.50;
                const pepperoniPrice = 13.00;
                
                const neapolitanTotal = neapolitanPrice * parseInt(neapolitanQuantity.value || 0);
                const pepperoniTotal = pepperoniPrice * parseInt(pepperoniQuantity.value || 0);
                
                const total = neapolitanTotal + pepperoniTotal;
                totalPrice.textContent = '$' + total.toFixed(2);
            }
            
            neapolitanQuantity.addEventListener('change', calculateTotal);
            pepperoniQuantity.addEventListener('change', calculateTotal);
            
            // Initialize total
            calculateTotal();
        });
    </script>
</body>
</html>