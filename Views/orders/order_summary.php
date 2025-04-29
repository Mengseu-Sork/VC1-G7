<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg mb-16 p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <h2 class="text-2xl font-semibold  mb-6">Order Details</h2>

                <!-- Order Summary -->
                <div class="mb-6">
                  <div class="mb-2"><span class="font-semibold">Item:</span> <?= htmlspecialchars($orderDetails["product_name"]) ?></div>
                  <div class="mb-2"><span class="font-semibold">Price:</span> $<?= number_format($orderDetails["total_amount"], 2) ?></div>
                </div>

                <!-- Customer Info -->
                <div class="mb-6">
                  <h3 class="text-lg font-medium mb-2">Customer Info</h3>
                  <div><span class="font-semibold">Name:</span> <?= htmlspecialchars($orderDetails["FirstName"] . " " . $orderDetails["LastName"]) ?></div>
                  <div><span class="font-semibold">Email:</span> <?= htmlspecialchars($orderDetails["email"]) ?></div>
                  <div><span class="font-semibold">Phone:</span> <?= htmlspecialchars($orderDetails["phone"]) ?></div>
                </div>

                <!-- Timeline -->
                <div class="mb-6">
                  <h3 class="text-lg font-medium mb-2">Timeline</h3>
                  <ul class="list-disc list-inside space-y-1 text-sm font-semibold">
                    <li>Order Processed: The order is being prepared (products are being packed)</li>
                    <li>Payment Confirmed: Payment has been successfully processed and verified.</li>
                    <li>Order Placed: Order has been successfully placed by the customer.</li>
                  </ul>
                </div>

                <!-- Payment Info -->
                <div>
                  <h3 class="text-lg font-medium font-semibold mb-2">Payment Info</h3>
                  <div><span class="font-semibold">Total:</span> $<?= number_format($orderDetails["total_amount"], 2) ?></div>
                </div>
              </div>
        </div>
    </div>
</div>