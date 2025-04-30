<div class="mx-auto flex-1 h-full overflow-x-hidden overflow-y-auto">
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
        <div x-data="{ bgColor: 'white' }" class="rounded-lg p-6">
            <div class="shadow-lg rounded-lg mb-16 p-6 border-2 border-gray-200 dark:border-primary-darker transition duration-300"
                 :style="{ backgroundColor: bgColor }">
                <!-- Balance and Status Cards -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-5">
                    <div class="flex flex-wrap justify-between items-center gap-5">
                        <div class="min-w-[500px] mr-12">
                            <div class="text-sm text-gray-600 mb-2">Available Balance</div>
                            <div class="text-3xl font-bold mb-4">
                                <?php $totalPrice = 0; ?>    
                                <?php foreach ($orders as $key => $order) :?>
                                    <?php 
                                    $totalPrice += $order['total_amount'];
                                    ?>
                                <?php endforeach ?>
                                $ <?php echo $totalPrice; ?>
                            </div>
                            <div class="flex gap-4 mb-4">
                                <div class="flex items-center space-x-3 bg-green-50 px-4 py-2 rounded-lg">
                                    <div class="w-5 h-5 bg-green-500 text-white flex items-center justify-center text-xs rounded-full">✓</div>
                                    <div>
                                        <div class="font-semibold text-lg">$120,680.00</div>
                                        <div class="text-sm text-gray-600">Paid</div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 bg-blue-50 px-4 py-2 rounded-lg">
                                    <div class="w-5 h-5 bg-blue-500 text-white flex items-center justify-center text-xs rounded-full">R</div>
                                    <div>
                                        <div class="text-sm text-gray-600">Reserved</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <button class="bg-white text-green-600 border border-green-600 py-2 px-4 rounded-md text-sm font-medium hover:opacity-90 transition">Fill Out Balance</button>
                                <button class="bg-blue-600 text-white py-2 px-6 rounded-md text-sm font-medium hover:opacity-90 transition">Approve All</button>
                            </div>
                        </div>
                        
                        <div class="flex flex-1 gap-8 overflow-x-auto">
                            <div class="w-56 bg-blue-600 text-white rounded-lg p-5 relative">
                                <div class="flex items-center gap-2 text-sm mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Drafts
                                </div>
                                <div class="text-4xl font-bold mb-2">72</div>
                                <div class="text-sm opacity-80">32 Creators</div>
                            </div>
                            
                            <div class="w-56 bg-gray-800 text-white rounded-lg p-5 relative">
                                <div class="flex items-center gap-2 text-sm mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <polyline points="12 6 12 12 16 14"></polyline>
                                    </svg>
                                    Pending
                                </div>
                                <div class="text-4xl font-bold mb-2">122</div>
                                <div class="text-sm opacity-80">60 Creators</div>
                            </div>
                            
                            <div class="w-56 bg-green-600 text-white rounded-lg p-5 relative">
                                <div class="flex items-center gap-2 text-sm mb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    Paid
                                </div>
                                <div class="text-4xl font-bold mb-2">96</div>
                                <div class="text-sm opacity-80">57 Creators</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Invoices Section -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex flex-wrap justify-between mb-4 gap-4">
                        <div class="relative flex-1 min-w-[300px]">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </div>
                            <input type="text" class="w-full pl-10 py-3 border border-gray-300 rounded-md text-sm" placeholder="Search invoice">
                        </div>
                        
                        <div class="flex gap-3">
                            <button class="border border-gray-300 bg-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2 hover:opacity-90 transition">
                                Creator
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            
                            <button class="border border-gray-300 bg-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-2 hover:opacity-90 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="4" y1="21" x2="4" y2="14"></line>
                                    <line x1="4" y1="10" x2="4" y2="3"></line>
                                    <line x1="12" y1="21" x2="12" y2="12"></line>
                                    <line x1="12" y1="8" x2="12" y2="3"></line>
                                    <line x1="20" y1="21" x2="20" y2="16"></line>
                                    <line x1="20" y1="12" x2="20" y2="3"></line>
                                    <line x1="1" y1="14" x2="7" y2="14"></line>
                                    <line x1="9" y1="8" x2="15" y2="8"></line>
                                    <line x1="17" y1="16" x2="23" y2="16"></line>
                                </svg>
                                Sort
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto max-h-[500px] relative">
                        <table class="w-full border-collapse min-w-[800px]">
                            <thead>
                                <tr>
                                    <th><div class="w-5 h-5 border border-gray-300 rounded-md"></div></th>
                                    <th class="text-left px-4 py-3 text-sm text-gray-600 uppercase">INVOICE ID</th>
                                    <th class="text-left px-4 py-3 text-sm text-gray-600 uppercase">AMOUNT</th>
                                    <th class="text-left px-4 py-3 text-sm text-gray-600 uppercase">DATE</th>
                                    <th class="text-left px-4 py-3 text-sm text-gray-600 uppercase">CREATOR</th>
                                    <th class="text-left px-4 py-3 text-sm text-gray-600 uppercase">STATUS</th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php foreach ($orders as $index => $order) : ?>
                                <tr class="border-t border-gray-300">
                                    <td><div class="w-5 h-5 border border-gray-300 rounded-md"></div></td>
                                    <td class="text-blue-600 font-medium px-4 py-4">#00181-5404</td>
                                    <td class="px-4 py-4"><?php echo($order['total_amount']) ?></td>
                                    <td class="px-4 py-4"><?php echo($order['order_date']) ?></td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center gap-2">
                                            <?php echo($order['FirstName']) ?> <?php echo($order['LastName']) ?> 
                                        </div>
                                    </td>
                                    <td><span class="inline-block bg-blue-50 text-blue-600 py-2 px-4 rounded-md text-xs font-medium">Draft</span></td>
                                    <td class="text-gray-600 font-bold cursor-pointer">⋯</td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

