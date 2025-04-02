<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center">Forgot Password</h2>
        <p class="text-gray-600 text-center">Enter your phone number to reset your password.</p>

        <!-- Success/Error Message -->
        <?php if (isset($_SESSION["message"])): ?>
            <div class="text-green-600"><?php echo $_SESSION["message"]; unset($_SESSION["message"]); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION["error"])): ?>
            <div class="text-red-600"><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></div>
        <?php endif; ?>

        <form method="post" class="mt-4 space-y-4">
            <input type="text" name="phone" required placeholder="Enter your phone number" 
                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                Send Reset Code
            </button>
        </form>
        <div class="mt-4 text-center">
            <a href="/views/auth/login.php" class="text-blue-500 hover:underline">Back to Login</a>
        </div>
    </div>
</body>
</html>