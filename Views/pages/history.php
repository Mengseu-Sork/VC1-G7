<?php
require_once (__DIR__ . '/../layout/navbarUser/header_user.php');
require_once (__DIR__ . '/../layout/navbarUser/nav_user.php');


?>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .container {
            width: 83vw;
            height: 70vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: white;
            padding: 20px;
            box-sizing: border-box;
        }
        .search-bar {
            display: flex;
            align-items: center;
            width: 80%;
            margin-bottom: 15px;
        }
        .search-bar input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .search-bar button {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            margin-left: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            font-weight: bold;
        }
        .qr-button {
            background: #5ec2cc;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button>&#128197;</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Table</th>
                    <th>Amount</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#00001</td>
                    <td>17-February-2025</td>
                    <td>15</td>
                    <td>$80</td>
                    <td><button class="qr-button">QR Code</button></td>
                </tr>
                <tr>
                    <td>#00002</td>
                    <td>17-February-2025</td>
                    <td>10</td>
                    <td>$50</td>
                    <td><button class="qr-button">QR Code</button></td>
                </tr>
                <tr>
                    <td>#00003</td>
                    <td>17-February-2025</td>
                    <td>5</td>
                    <td>$35</td>
                    <td><button class="qr-button">QR Code</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
require_once (__DIR__ . '/../layout/navbarUser/footer_user.php');
?>
