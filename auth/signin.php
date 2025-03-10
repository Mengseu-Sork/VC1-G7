<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>SING IN</h2>
            <form action="process.php" method="POST">
                <label>Email</label>
                <input type="email" name="email" required placeholder="abc@gmail.com">

                <label>Password</label>
                <input type="password" name="password" required placeholder="Password">
                
                <a href="#">Forgot your password?</a>
                <p>or sign in with Gmail</p>
                <button class="google-btn">Continue with Google</button>
                <button type="submit" name="login">SING IN</button>
            </form>
        </div>

        <div class="register-box">
            <h2>Hello, User!</h2>
            <p>Enter your personal details and start your journey with us</p>
            <a href="./register.php"><button>REGISTER</button></a>
        </div>
    </div>
</body>
</html>
