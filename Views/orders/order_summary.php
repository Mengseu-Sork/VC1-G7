<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Order Details</title>  
    <style>  
        body {  
            font-family: Arial, sans-serif;  
            margin: 20px;  
            background-color: #f8f9fa;  
        }  
        .order-container {  
            border: 1px solid #ccc;  
            border-radius: 5px;  
            padding: 20px;  
            background-color: #fff;  
        }  
        h2 {  
            color: #333;  
        }  
        .order-summary {  
            margin-bottom: 20px;  
        }  
        .order-item {  
            margin: 10px 0;  
        }  
        .payment-info, .customer-info {  
            margin-top: 20px;  
        }  
        .timeline {  
            margin-top: 20px;  
        }  
    </style>  
</head>  
<body>  


<div class="order-container">  
    <h2>Order Details</h2>  
    
    <div class="order-summary">  
        <div class="order-item"><strong>Item:</strong> <?php echo($orderDetails["product_name"])?> </div>  
        <div class="order-item"><strong>Price:</strong> $ <?php echo($orderDetails["total_amount"])?></div>  
    </div>  

    <div class="customer-info">  
        <strong>Customer Name:</strong> <?php echo($orderDetails["FirstName"])?> <?php echo($orderDetails["LastName"])?><br>  
        <strong>Email:</strong><?php echo($orderDetails["email"])?><br>  
        <strong>Phone:</strong> <?php echo($orderDetails["phone"])?><br>  
    </div>  

    <div class="timeline">  
        <strong>Timeline:</strong><br>  
        <ul>  
            <li>Order Processed: The order is being prepared (products are being packed)</li>  
            <li>Payment Confirmed: Payment has been successfully processed and verified.</li>  
            <li>Order Placed: Order has been successfully placed by the customer.</li>  
        </ul>  
    </div>  

    <div class="payment-info">  
        <strong>Payment:</strong><br>  
        <div class="order-item"><strong>Total:</strong> $<?php echo($orderDetails["total_amount"])?></div>  
    </div>  
</div>  

</body>  
</html>  