<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            color: #777;
            font-weight: normal;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        td {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        tr:last-child td {
            border-bottom: 1px solid #ddd;
        }
        .view-details {
            color: #4a90e2;
            text-decoration: none;
        }
        .view-details:hover {
            text-decoration: underline;
        }
        .view-details:before {
            content: '› ';
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Order no.</th>
                <th>Order date</th>
                <th>Bill-to name</th>
                <th>Total</th>
                <th>Track & trace number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>SO-1606070005</td>
                <td>6/7/2016</td>
                <td>John Doe</td>
                <td>$318.24</td>
                <td><a href="#" class="view-details">View details</a></td>
            </tr>
            <tr>
                <td>SO-1606070004</td>
                <td>6/7/2016</td>
                <td>John Doe</td>
                <td>$122.90</td>
                <td><a href="#" class="view-details">View details</a></td>
            </tr>
            <tr>
                <td>SO-1606070003</td>
                <td>6/7/2016</td>
                <td>John Doe</td>
                <td>$516.91</td>
                <td><a href="#" class="view-details">View details</a></td>
            </tr>
            <tr>
                <td>SO-1606070002</td>
                <td>6/7/2016</td>
                <td>John Doe</td>
                <td>$723.55</td>
                <td><a href="#" class="view-details">View details</a></td>
            </tr>
            <tr>
                <td>SO-1606070001</td>
                <td>6/7/2016</td>
                <td>John Doe</td>
                <td>$137.94</td>
                <td><a href="#" class="view-details">View details</a></td>
            </tr>
            <tr>
                <td>SO-1606070000</td>
                <td>6/7/2016</td>
                <td>John Doe</td>
                <td>$436.08</td>
                <td><a href="#" class="view-details">View details</a></td>
            </tr>
            <tr>
                <td>SO-108589</td>
                <td>3/18/2016</td>
                <td>John Doe</td>
                <td>$91.74</td>
                <td><a href="#" class="view-details">View details</a></td>
            </tr>
        </tbody>
    </table>
</body>
</html>