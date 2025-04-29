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
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .dashboard-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 24px;
            margin-bottom: 20px;
        }
        
        /* Balance Section */
        .balance-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }
        
        .balance-info {
            flex: 1;
            min-width: 300px;
        }
        
        .balance-label {
            font-size: 14px;
            color: #4A5568;
            margin-bottom: 8px;
        }
        
        .balance-amount {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        
        .balance-details {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }
        
        .balance-detail {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            background-color: var(--light-gray);
            border-radius: 8px;
            gap: 8px;
        }
        
        .balance-detail.paid {
            background-color: #E6F7F1;
        }
        
        .balance-detail.reserved {
            background-color: #EBF0FF;
        }
        
        .icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: white;
        }
        
        .icon.paid {
            background-color: var(--primary-green);
        }
        
        .icon.reserved {
            background-color: var(--primary-blue);
        }
        
        .detail-amount {
            font-weight: 600;
            font-size: 14px;
        }
        
        .detail-label {
            font-size: 12px;
            color: #4A5568;
        }
        
        .balance-actions {
            display: flex;
            gap: 12px;
        }
        
        .btn {
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .btn-outline {
            background-color: white;
            color: var(--primary-green);
            border: 1px solid var(--primary-green);
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        /* Status Cards */
        .status-cards {
            display: flex;
            gap: 16px;
            flex: 2;
            min-width: 300px;
            overflow-x: auto;
        }
        
        .status-card {
            flex: 1;
            min-width: 150px;
            padding: 20px;
            border-radius: 8px;
            color: white;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .status-card.drafts {
            background-color: var(--primary-blue);
        }
        
        .status-card.pending {
            background-color: var(--dark-gray);
        }
        
        .status-card.paid {
            background-color: var(--primary-green);
        }
        
        .status-title {
            font-size: 14px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .status-count {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .status-creators {
            font-size: 12px;
            opacity: 0.8;
        }
        
        .arrow {
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
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--medium-gray);
            margin-bottom: 16px;
        }
        
        .tab {
            padding: 12px 16px;
            font-size: 14px;
            cursor: pointer;
            color: #4A5568;
            position: relative;
        }
        
        .tab.active {
            color: var(--primary-blue);
            font-weight: 500;
        }
        
        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-blue);
        }
        
        /* Search Section */
        .search-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
            gap: 12px;
            flex-wrap: wrap;
        }
        
        .search-bar {
            flex: 1;
            min-width: 300px;
            position: relative;
        }
        
        .search-bar input {
            width: 100%;
            padding: 10px 10px 10px 36px;
            border: 1px solid var(--medium-gray);
            border-radius: 6px;
            font-size: 14px;
        }
        
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #4A5568;
        }
        
        .filter-buttons {
            display: flex;
            gap: 8px;
        }
        
        .filter-btn {
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
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th {
            text-align: left;
            padding: 12px 16px;
            font-size: 12px;
            font-weight: 500;
            color: #4A5568;
            text-transform: uppercase;
        }
        
        td {
            padding: 16px;
            border-top: 1px solid var(--medium-gray);
            font-size: 14px;
        }
        
        .checkbox {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 1px solid var(--medium-gray);
            cursor: pointer;
        }
        
        .invoice-id {
            color: var(--primary-blue);
            font-weight: 500;
        }
        
        .creator-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .creator-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-badge.draft {
            background-color: var(--draft-bg);
            color: var(--draft-color);
        }
        
        .status-badge.pending {
            background-color: var(--pending-bg);
            color: var(--pending-color);
        }
        
        .status-badge.paid {
            background-color: var(--paid-bg);
            color: var(--paid-color);
        }
        
        .actions {
            color: #4A5568;
            cursor: pointer;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .balance-section {
                flex-direction: column;
            }
            
            .status-cards {
                width: 100%;
            }
            
            .search-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Balance and Status Cards -->
        <div class="dashboard-card">
            <div class="balance-section">
                <div class="balance-info">
                    <div class="balance-label">Available Balance</div>
                    <div class="balance-amount">$252,345.00</div>
                    <div class="balance-details">
                        <div class="balance-detail paid">
                            <div class="icon paid">✓</div>
                            <div>
                                <div class="detail-amount">$120,680.00</div>
                                <div class="detail-label">Paid</div>
                            </div>
                        </div>
                        <div class="balance-detail reserved">
                            <div class="icon reserved">R</div>
                            <div>
                                <div class="detail-amount">$47,320.00</div>
                                <div class="detail-label">Reserved</div>
                            </div>
                        </div>
                    </div>
                    <div class="balance-actions">
                        <button class="btn btn-outline">Fillout Balance</button>
                        <button class="btn btn-primary">Approve All</button>
                    </div>
                </div>
                
                <div class="status-cards">
                    <div class="status-card drafts">
                        <div class="status-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Drafts
                        </div>
                        <div class="status-count">72</div>
                        <div class="status-creators">32 Creators</div>
                        <div class="arrow">›</div>
                    </div>
                    
                    <div class="status-card pending">
                        <div class="status-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            Pending
                        </div>
                        <div class="status-count">122</div>
                        <div class="status-creators">60 Creators</div>
                        <div class="arrow">›</div>
                    </div>
                    
                    <div class="status-card paid">
                        <div class="status-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            Paid
                        </div>
                        <div class="status-count">96</div>
                        <div class="status-creators">57 Creators</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Invoices Section -->
        <div class="dashboard-card">
                       <div class="search-section">
                <div class="search-bar">
                    <div class="search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                    <input type="text" placeholder="Search invoice">
                </div>
                
                <div class="filter-buttons">
                    <button class="filter-btn">
                        Creator
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    
                    <button class="filter-btn">
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
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th><div class="checkbox"></div></th>
                            <th>INVOICE ID</th>
                            <th>AMOUNT</th>
                            <th>DATE</th>
                            <th>CREATOR</th>
                            <th>STATUS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><div class="checkbox"></div></td>
                            <td class="invoice-id">#00181-5404</td>
                            <td>$25,000.00</td>
                            <td>Jul 16, 2020</td>
                            <td>
                                <div class="creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Mattie Stone" class="creator-avatar">
                                    Mattie Stone
                                </div>
                            </td>
                            <td><span class="status-badge draft">Draft</span></td>
                            <td class="actions">⋯</td>
                        </tr>
                        <tr>
                            <td><div class="checkbox"></div></td>
                            <td class="invoice-id">#73597-9803</td>
                            <td>$14,000.00</td>
                            <td>Jul 12, 2020</td>
                            <td>
                                <div class="creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Alexander Richards" class="creator-avatar">
                                    Alexander Richards
                                </div>
                            </td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td class="actions">⋯</td>
                        </tr>
                        <tr>
                            <td><div class="checkbox"></div></td>
                            <td class="invoice-id">#99576-8765</td>
                            <td>$18,000.00</td>
                            <td>Jul 10, 2020</td>
                            <td>
                                <div class="creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Matthew Mitchell" class="creator-avatar">
                                    Matthew Mitchell
                                </div>
                            </td>
                            <td><span class="status-badge paid">Paid</span></td>
                            <td class="actions">⋯</td>
                        </tr>
                        <tr>
                            <td><div class="checkbox"></div></td>
                            <td class="invoice-id">#10338-2087</td>
                            <td>$16,000.00</td>
                            <td>Jul 10, 2020</td>
                            <td>
                                <div class="creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Lillian McGee" class="creator-avatar">
                                    Lillian McGee
                                </div>
                            </td>
                            <td><span class="status-badge draft">Draft</span></td>
                            <td class="actions">⋯</td>
                        </tr>
                        <tr>
                            <td><div class="checkbox"></div></td>
                            <td class="invoice-id">#28701-5681</td>
                            <td>$5,000.00</td>
                            <td>Jun 24, 2020</td>
                            <td>
                                <div class="creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Blake Griffith" class="creator-avatar">
                                    Blake Griffith
                                </div>
                            </td>
                            <td><span class="status-badge draft">Draft</span></td>
                            <td class="actions">⋯</td>
                        </tr>
                        <tr>
                            <td><div class="checkbox"></div></td>
                            <td class="invoice-id">#11471-1285</td>
                            <td>$120,000.00</td>
                            <td>Jun 22, 2020</td>
                            <td>
                                <div class="creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Bettie Stanley" class="creator-avatar">
                                    Bettie Stanley
                                </div>
                            </td>
                            <td><span class="status-badge paid">Paid</span></td>
                            <td class="actions">⋯</td>
                        </tr>
                        <tr>
                            <td><div class="checkbox"></div></td>
                            <td class="invoice-id">#81843-1056</td>
                            <td>$55,000.00</td>
                            <td>Jun 18, 2020</td>
                            <td>
                                <div class="creator-cell">
                                    <img src="/placeholder.svg?height=32&width=32" alt="Addie Marshall" class="creator-avatar">
                                    Addie Marshall
                                </div>
                            </td>
                            <td><span class="status-badge pending">Pending</span></td>
                            <td class="actions">⋯</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>