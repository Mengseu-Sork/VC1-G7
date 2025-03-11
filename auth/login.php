<?php
require_once "../Databases/Database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Secure password hashing

    // Check if email already exists
    $stmt = $pdo->query("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->execute([$email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        echo "<script>alert('Email already registered!');</script>";
    } else {
        // Insert new user
        $stmt = $pdo->query("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $hashedPassword])) {
            echo "<script>alert('Registration successful! Please log in.');</script>";
            header("Location: login.php");
            exit;
        } else {
            echo "<script>alert('Error registering user. Try again!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <style>
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row w-75 shadow-lg p-4 rounded">
        <div class="col-md-6 p-4 border-end">
            <h2 class="text-center">SIGN IN</h2>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="abc@gmail.com">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="position-relative">
                        <input type="password" id="password" name="password" class="form-control pe-5" required placeholder="Password">
                        <button type="button" class="btn position-absolute end-0 top-50 translate-middle-y me-2 p-0" onclick="togglePassword()" style="border: none; background: none;">
                            <i id="toggleIcon" class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-3 text-end">
                    <a href="#" class="text-decoration-none">Forgot your password?</a>
                </div>
                <p class="text-center">or sign in with Gmail</p>
                <div class="d-grid gap-2">
                    <button class="btn btn-danger">Continue with Google</button>
                    <button type="submit" name="login" class="btn btn-primary">SIGN IN</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 p-4 text-center bg-light">
            <h2>Hello, User!</h2>
            <p>Enter your personal details and start your journey with us</p>
            <a href="./register.php" class="btn btn-success">REGISTER</a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const toggleIcon = document.getElementById("toggleIcon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
        }
    }
</script>

</body>
</html>