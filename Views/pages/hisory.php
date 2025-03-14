<?php
require_once '../layout/navbarUser/header_user.php';
require_once '../layout/navbarUser/nav_user.php';
require_once '../layout/navbarUser/sidebar.php';
require_once '../layout/navbarUser/footer_user.php';
?>
<div class="mx-auto p-6">
<div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg p-6 transition duration-300 border-2 dark:border-primary-darker" :style="{ backgroundColor: bgColor }">
            <h2 class="text-xl font-semibold mb-4">Order List</h2>
            <div class="p-6 border-1 dark:border-primary-darker">
                <table class="min-w-full border border-2 dark:border-primary-darker">
                    <thead >
                        <tr class="dark:border-primary-darker">
                            <th class="py-3 px-4 border-2 dark:border-primary-darker">Order ID</th>
                            <th class="py-3 px-4 border-2 dark:border-primary-darker">Date</th>
                            <th class="py-3 px-4 border-2 dark:border-primary-darker">Total</th>
                            <th class="py-3 px-4 border-2 dark:border-primary-darker">Amount</th>
                            <th class="py-3 px-4 border-2 dark:border-primary-darker">Payment</th>
                        </tr>
                    </thead>
                    <tbody id="orderTable">
                        <tr class="">
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">#00001</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">17-February-2025</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">10</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">$80</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker flex justify-center items-center">
                                <button class="bg-blue-500 text-white rounded-lg px-2 py-1 hover:bg-blue-600 transition duration-200">QR Code</button>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">#00002</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">17-February-2025</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">15</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">$80</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker flex justify-center items-center">
                                <button class="bg-blue-500 text-white rounded-lg px-2 py-1 hover:bg-blue-600 transition duration-200">QR Code</button>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">#00003</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">18-February-2025</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">25</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">$30</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker flex justify-center items-center">
                                <button class="bg-blue-500 text-white rounded-lg px-2 py-1 hover:bg-blue-600 transition duration-200">QR Code</button>
                            </td>
                        </tr>
                        <tr class=" ">
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">#00004</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">18-February-2025</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">5</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">$35</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker flex justify-center items-center">
                                <button class="bg-blue-500 text-white rounded-lg px-2 py-1 hover:bg-blue-600 transition duration-200">QR Code</button>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">#00005</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">19-February-2025</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">10</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker">$120</td>
                            <td class="py-2 px-4 border-2 dark:border-primary-darker flex justify-center items-center">
                                <button class="bg-blue-500 text-white rounded-lg px-2 py-1 hover:bg-blue-600 transition duration-200">QR Code</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>