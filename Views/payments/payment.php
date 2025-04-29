<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Management Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
    <style>
        :root {
            --primary-blue: #4263EB;
            --primary-green: #10B981;
            --dark-gray: #2D3748;
            --light-gray: #F7FAFC;
            --medium-gray: #E2E8F0;
            --pending-color: #4A5568;
            --pending-bg: #EDF2F7;
            --draft-color: #4263EB;
            --draft-bg: #EBF0FF;
            --paid-color: #10B981;
            --paid-bg: #E6F7F1;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #F5F7FB;
            color: #1A202C;
            padding: 20px;
        }
        
        .inv-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .inv-dashboard-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 24px;
            margin-bottom: 20px;
        }
        
        /* Balance Section */
        .inv-balance-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }
        
        .inv-balance-info {
            flex: 1;
            min-width: 300px;
        }
        
        .inv-balance-label {
            font-size: 14px;
            color: #4A5568;
            margin-bottom: 8px;
        }
        
        .inv-balance-amount {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        
        .inv-balance-details {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }
        
        .inv-balance-detail {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background-color: var(--light-gray);
            border-radius: 8px;
            gap: 8px;
        }
        
        .inv-balance-detail.inv-paid {
            background-color: #E6F7F1;
        }
        
        .inv-balance-detail.inv-reserved {
            background-color: #EBF0FF;
        }
        
        .inv-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
        }
        
        .inv-icon.inv-paid {
            background-color: var(--primary-green);
        }
        
        .inv-icon.inv-reserved {
            background-color: var(--primary-blue);
        }
        
        .inv-detail-amount {
            font-weight: 600;
            font-size: 14px;
        }
        
        .inv-detail-label {
            font-size: 12px;
            color: #4A5568;
        }
        
        .inv-balance-actions {
            display: flex;
            gap: 12px;
        }
        
        .inv-btn {
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        
        .inv-btn-primary {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .inv-btn-outline {
            background-color: white;
            color: var(--primary-green);
            border: 1px solid var(--primary-green);
        }
        
        .inv-btn:hover {
            opacity: 0.9;
        }
        
        /* Status Cards */
        .inv-status-cards {
            display: flex;
            gap: 16px;
            flex: 2;
            min-width: 300px;
            overflow-x: auto;
        }
        
        .inv-status-card {
            flex: 1;
            min-width: 150px;
            padding: 20px;
            border-radius: 8px;
            color: white;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .inv-status-card.inv-drafts {
            background-color: var(--primary-blue);
        }
        
        .inv-status-card.inv-pending {
            background-color: var(--dark-gray);
        }
        
        .inv-status-card.inv-paid {
            background-color: var(--primary-green);
        }
        
        .inv-status-title {
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .inv-status-count {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .inv-status-creators {
            font-size: 12px;
            opacity: 0.8;
        }
        
        .inv-arrow {
            position: absolute;
            right: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4A5568;
            font-size: 10px;
            z-index: 1;
        }
        
        /* Tabs Section */
        .inv-tabs {
            display: flex;
            border-bottom: 1px solid var(--medium-gray);
            margin-bottom: 16px;
        }
        
        .inv-tab {
            padding: 12px 16px;
            font-size: 14px;
            cursor: pointer;
            color: #4A5568;
            position: relative;
        }
        
        .inv-tab.inv-active {
            color: var(--primary-blue);
            font-weight: 500;
        }
        
        .inv-tab.inv-active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-blue);
        }
        
        /* Search Section */
        .inv-search-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .inv-search-bar {
            flex: 1;
            min-width: 300px;
            position: relative;
        }
        
        .inv-search-bar input {
            width: 100%;
            padding: 10px 10px 10px 36px;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            font-size: 14px;
        }
        
        .inv-search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #4A5568;
        }
        
        .inv-filter-buttons {
            display: flex;
            gap: 8px;
        }
        
        .inv-filter-btn {
            padding: 10px 16px;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            background-color: white;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }
        
        /* Table Section */
        .inv-table-container {
            overflow-x: auto;
            overflow-y: auto;
            max-height: 500px;
            position: relative;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 500;
            color: #4A5568;
            text-transform: uppercase;
            background-color: white;
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        td {
            padding: 16px;
            border-top: 1px solid var(--medium-gray);
            font-size: 14px;
        }
        
        .inv-checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid var(--medium-gray);
            cursor: pointer;
        }
        
        .inv-invoice-id {
            color: var(--primary-blue);
            font-weight: 500;
        }
        
        .inv-creator-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .inv-creator-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .inv-status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .inv-status-badge.inv-draft {
            background-color: var(--draft-bg);
            color: var(--draft-color);
        }
        
        .inv-status-badge.inv-pending {
            background-color: var(--pending-bg);
            color: var(--pending-color);
        }
        
        .inv-status-badge.inv-paid {
            background-color: var(--paid-bg);
            color: var(--paid-color);
        }
        
        .inv-actions {
            color: #4A5568;
            cursor: pointer;
            font-weight: bold;
        }
        
        /* Scrollbar Styling */
        .inv-table-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        .inv-table-container::-webkit-scrollbar-track {
            background: var(--light-gray);
            border-radius: 4px;
        }
        
        .inv-table-container::-webkit-scrollbar-thumb {
            background: var(--medium-gray);
            border-radius: 4px;
        }
        
        .inv-table-container::-webkit-scrollbar-thumb:hover {
            background: var(--dark-gray);
        }
        
        @media (max-width: 768px) {
            .inv-balance-section {
                flex-direction: column;
            }
            
            .inv-status-cards {
                width: 100%;
            }
            
            .inv-search-section {
                flex-direction: column;
            }
            
            .inv-table-container {
                max-height: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="inv-container">
        <!-- Balance and Status Cards -->
        <div class="inv-dashboard-card">
            <div class="inv-balance-section">
                <div class="inv-balance-info">
                    <div class="inv-balance-label">Available Balance</div>
                    <div class="inv-balance-amount">
                    <?php $totalPrice = 0; ?>    
                    <?php foreach ($orders as $key => $order) :?>
                        <?php 
                        $totalPrice += $order['total_amount'];
                        ?>
                    <?php endforeach ?>
                    $ <?php echo $totalPrice; ?>
                    </div>
                    <div class="inv-balance-details">
                        <div class="inv-balance-detail inv-paid">
                            <div class="inv-icon inv-paid">✓</div>
                            <div>
                                <div class="inv-detail-amount">$120,680.00</div>
                                <div class="inv-detail-label">Paid</div>
                            </div>
                        </div>
                        <div class="inv-balance-detail inv-reserved">
                            <div class="inv-icon inv-reserved">R</div>
                            <div>
                                <div class="inv-detail-label">Reserved</div>
                            </div>
                        </div>
                    </div>
                    <div class="inv-balance-actions">
                        <button class="inv-btn inv-btn-outline">Fill Out Balance</button>
                        <button class="inv-btn inv-btn-primary">Approve All</button>
                    </div>
                </div>
                
                <div class="inv-status-cards">
                    <div class="inv-status-card inv-drafts">
                        <div class="inv-status-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Drafts
                        </div>
                        <div class="inv-status-count">72</div>
                        <div class="inv-status-creators">32 Creators</div>
                        <div class="inv-arrow">›</div>
                    </div>
                    
                    <div class="inv-status-card inv-pending">
                        <div class="inv-status-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            Pending
                        </div>
                        <div class="inv-status-count">122</div>
                        <div class="inv-status-creators">60 Creators</div>
                        <div class="inv-arrow">›</div>
                    </div>
                    
                    <div class="inv-status-card inv-paid">
                        <div class="inv-status-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Paid
                        </div>
                        <div class="inv-status-count">96</div>
                        <div class="inv-status-creators">57 Creators</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Invoices Section -->
        <div class="inv-dashboard-card">
            <div class="inv-search-section">
                <div class="inv-search-bar">
                    <div class="inv-search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <input type="text" placeholder="Search invoice">
                </div>
                
                <div class="inv-filter-buttons">
                    <button class="inv-filter-btn">
                        Creator
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    
                    <button class="inv-filter-btn">
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
            
            <div class="inv-table-container">
                <table>
                    <thead>
                        <tr>
                            <th><div class="inv-checkbox"></div></th>
                            <th>INVOICE ID</th>
                            <th>AMOUNT</th>
                            <th>DATE</th>
                            <th>CREATOR</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach ($orders as $index => $order) : ?>
                        <tr>
                            <td><div class="inv-checkbox"></div></td>
                            <td class="inv-invoice-id">#00181-5404</td>
                            <td><?php echo($order['total_amount']) ?></td>
                            <td><?php echo($order['order_date']) ?></td>
                            <td>
                                <div class="inv-creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Mattie Stone" class="inv-creator-avatar">
                                    <?php echo($order['FirstName']) ?> 
                                    <?php echo($order['LastName']) ?> 
                                </div>
                            </td>
                            <td><span class="inv-status-badge inv-draft">Draft</span></td>
                            <td class="inv-actions">⋯</td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>