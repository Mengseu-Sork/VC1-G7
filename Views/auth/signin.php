<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - XING FU CHA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col items-center justify-center min-h-screen bg-[url('../../../Assets/images/photo_2025-03-12_07-22-11.jpg')] bg-cover bg-center">
    <div class="w-full max-w-md p-8 space-y-6 bg-white shadow-md rounded-lg">
        <div class="text-center">
            <img src="../../../Assets/images/FX12 LOGO.png" alt="XING FU CHA Logo" class="w-24 mx-auto">
            <h2 class="text-2xl font-semibold mt-4">Welcome to Cafe Shop</h2>
            <p class="text-gray-600">Login to your account to continue</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="flex items-center p-3 text-red-600 bg-red-100 rounded-md">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span><?php echo $error; ?></span>
            </div>
        <?php endif; ?>

        <form action="/auth/signin" method="post" class="space-y-4">
            <div>
                <label for="email" class="block font-medium">Email</label>
                <div class="relative mt-1">
                    <i class="fas fa-envelope absolute left-3 top-3 text-gray-400"></i>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required 
                        class="w-full px-5 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label for="password" class="block font-medium">Password</label>
                <div class="relative mt-1">
                    <i class="fas fa-lock absolute left-3 top-3 text-gray-400"></i>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required 
                        class="w-full px-5 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <button type="button" id="togglePassword" class="absolute right-3 top-2 text-gray-500">
                    <i class="fas fa-eye"></i>
                </button>
            </div>

            <div class="flex justify-between items-center text-sm mt-3">
                <label class="flex items-center">
                    <input type="checkbox" id="rememberMe" class="mr-2">
                    <span>Remember</span>
                </label>
                <a href="/forgot-password" class="text-blue-500 hover:underline">Forgot Password?</a>
            </div>

            <button type="submit" class="w-full py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Login</button>

            <!-- <div class="text-center text-gray-500">Or login with</div>
            <div class="flex gap-4">
                <button type="button" class="flex-1 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                    <i class="fab fa-google mr-2"></i> Google
                </button>
                <button type="button" class="flex-1 py-2 text-white bg-blue-800 rounded-md hover:bg-blue-900">
                    <i class="fab fa-facebook-f mr-2"></i> Facebook
                </button>
            </div> -->
        </form>

        <div class="text-center text-gray-600">
            <p>Don't have an account? <a href="/Views/auth/register.php" class="text-blue-500 hover:underline">Register</a></p>
        </div>
    </div>
    <script>
        document.getElementById("rememberMe").addEventListener("change", function () {
            let passwordInput = document.getElementById("password");
            passwordInput.type = this.checked ? "text" : "password";
        });
    </script>
</body>
</html>
