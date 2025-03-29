<form action="index.php?action=addOrder" method="POST">
    <label>User ID:</label>
    <input type="number" name="user_id" required><br>

    <label>Order Date:</label>
    <input type="date" name="order_date" required><br>

    <label>Total Amount:</label>
    <input type="number" step="0.01" name="total_amount" required><br>

    <button type="submit">Add Order</button>
</form>
