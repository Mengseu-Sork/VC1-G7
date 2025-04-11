<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800 max-w-xl mx-auto p-6">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold">Order Details</h1>
    </div>

    <form id="order-form">
        <!-- Products -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold mb-4">Products</h3>
            <div id="cartItems" class="space-y-4"></div>
        </div>

        <!-- Total -->
        <div class="text-right font-semibold text-lg mb-6">
            Total: <span id="total-price">$0.00</span>
        </div>

        <!-- Pickup Details -->
        <div class="mb-8">
            <p class="text-sm text-gray-500 mb-4">Please select your pickup details</p>

            <div class="mb-4">
                <label for="pickup-date" class="block text-sm font-medium mb-1">Pickup Date</label>
                <input type="date" id="pickup-date" name="pickup-date" required
                    class="w-full border border-gray-300 rounded px-3 py-2" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Pickup Time</label>
                <div class="flex items-center gap-2">
                    <select id="pickup-hour" name="pickup-hour" class="w-20 border border-gray-300 rounded px-2 py-1"
                        style="width: 70px;">
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
                    <span>:</span>
                    <select id="pickup-minute" name="pickup-minute"
                        class="w-20 border border-gray-300 rounded px-2 py-1">
                        <option value="00">00</option>
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="45">45</option>
                    </select>
                    <select id="pickup-ampm" name="pickup-ampm" class="w-20 border border-gray-300 rounded px-2 py-1">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                </div>
                <p class="text-xs text-gray-500 mt-1">Hour Minute</p>
            </div>
        </div>

        <!-- Customer Info -->
        <div class="mb-6">
            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label for="first-name" class="block text-sm font-medium mb-1">First Name</label>
                    <input type="text" id="first-name" name="first-name" required
                        class="w-full border border-gray-300 rounded px-3 py-2" placeholder="First Name" />
                </div>
                <div class="w-1/2">
                    <label for="last-name" class="block text-sm font-medium mb-1">Last Name</label>
                    <input type="text" id="last-name" name="last-name" required
                        class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Last Name" />
                </div>
            </div>

            <div class="flex gap-4 mb-4">
                <div class="w-1/2">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded px-3 py-2" placeholder="example@example.com" />
                </div>
                <div class="w-1/2">
                    <label for="phone" class="block text-sm font-medium mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required
                        class="w-full border border-gray-300 rounded px-3 py-2" placeholder="(000) 000-0000" />
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex justify-end gap-4">
            <button type="button" id="cancelBtn"
                class="w-28 bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 rounded shadow">
                Cancel
            </button>
            <button type="submit"
                class="w-28 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded shadow">
                Submit
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cartItemsContainer = document.getElementById('cartItems');
            const totalPriceElement = document.getElementById('total-price');
            const orderForm = document.getElementById('order-form');
            const cancelBtn = document.getElementById('cancelBtn');

            function getCart() {
                return JSON.parse(localStorage.getItem('cart') || '[]');
            }

            function saveCart(cart) {
                localStorage.setItem('cart', JSON.stringify(cart));
            }

            function calculateTotal() {
                const total = getCart().reduce((sum, item) => sum + item.price * item.quantity, 0);
                totalPriceElement.textContent = '$' + total.toFixed(2);
                return total;
            }

            function renderCart() {
                const cart = getCart();
                cartItemsContainer.innerHTML = '';

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = '<p class="text-sm text-gray-500">Your cart is empty.</p>';
                    totalPriceElement.textContent = '$0.00';
                    return;
                }

                cart.forEach((item, index) => {
                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'flex items-center justify-between border-b pb-4';

                    itemDiv.innerHTML = `
                        <div class="flex items-center">
                            <img src="../../Assets/images/uploads/${item.image}" alt="${item.name}" class="w-12 h-12 rounded-full mr-4" />
                            <div>
                                <h3 class="font-semibold">${item.name}</h3>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center border rounded px-2 py-1 space-x-2">
                                <button type="button" data-index="${index}" class="decreaseQty text-xl font-bold text-gray-600 hover:text-black">−</button>
                                <input type="text" id="quantity-${index}" value="${item.quantity}" readonly class="w-8 text-center bg-transparent border-none focus:outline-none" />
                                <button type="button" data-index="${index}" class="increaseQty text-xl font-bold text-gray-600 hover:text-black">+</button>
                            </div>
                        </div>
                        <div class="text-right font-medium w-20">$${(item.price * item.quantity).toFixed(2)}</div>
                    `;

                    itemDiv.querySelector('.increaseQty').addEventListener('click', function () {
                        const idx = parseInt(this.getAttribute('data-index'));
                        if (cart[idx].quantity < cart[idx].stock_quantity) {
                            cart[idx].quantity++;
                            saveCart(cart);
                            renderCart();
                        } else {
                            alert('Maximum stock quantity reached!');
                        }
                    });

                    itemDiv.querySelector('.decreaseQty').addEventListener('click', function () {
                        const idx = parseInt(this.getAttribute('data-index'));
                        if (cart[idx].quantity > 1) {
                            cart[idx].quantity--;
                            saveCart(cart);
                            renderCart();
                        }
                    });

                    cartItemsContainer.appendChild(itemDiv);
                });

                calculateTotal();
            }

            orderForm.addEventListener('submit', e => {
                e.preventDefault();
                const cart = getCart();
                if (cart.length === 0) {
                    alert('Your cart is empty.');
                    return;
                }

                const formData = new FormData(orderForm);
                const pickupTime = `${formData.get('pickup-hour')}:${formData.get('pickup-minute')} ${formData.get('pickup-ampm')}`;

                const orderDetails = {
                    cart: cart,
                    total: calculateTotal(),
                    customer: {
                        first_name: formData.get('first-name'),
                        last_name: formData.get('last-name'),
                        email: formData.get('email'),
                        phone: formData.get('phone'),
                    },
                    pickup_date: formData.get('pickup-date'),
                    pickup_time: pickupTime
                };

                console.log('Order details being sent:', orderDetails);

                fetch('/order/process', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(orderDetails)
                })
                    .then(response => {
                        console.log('Response status:', response.status);
                        if (!response.ok) {
                            return response.text().then(text => {
                                throw new Error(`HTTP error! Status: ${response.status} - ${text}`);
                            });
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            alert('Order placed successfully!');
                            localStorage.removeItem('cart');
                            window.location.href = '/orders/orderHistory';
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('An error occurred while placing the order: ' + error.message);
                    });
            });
            cancelBtn.addEventListener('click', () => {
                localStorage.removeItem('cart');
                window.location.href = '/pages/products';
            });

            renderCart();
        });
    </script>
</body>

</html>