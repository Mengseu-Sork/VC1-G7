<?php
require 'Databases/Database.php';

session_start();
require 'Databases/Database.php'; // Ensure this file correctly sets up $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form values
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Corrected SQL query (removed extra comma)
        $stmt = $pdo->prepare("INSERT INTO users (FisrtName, LastName, email, password) VALUES (?, ?, ?, ?)");

        // Execute the statement with the provided data
        if ($stmt->execute([$firstName, $lastName, $email, $password])) {
            echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Registration failed!');</script>";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('background.jpg') no-repeat center center;
            background-size: cover;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .left-box {
            background: url('coffee.jpg') no-repeat center center;
            background-size: cover;
            padding: 60px;
            color: white;
            text-align: center;
            border-radius: 10px 0 0 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-custom {
            background: black;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row w-75 shadow-lg">
            <div class="col-md-6 left-box d-none d-md-flex flex-column align-items-center text-black">
                <h2 class="fw-bold ">Welcome Back!</h2>
                <p class="mt-3">To keep connected with us please login with your personal info</p>
                <a href="/auth/login.php" class="btn btn-light w-75 mt-3">SIGN IN</a>
            </div>
            <div class="col-md-6 form-box">
                <h3 class="text-center fw-bold">Create Account</h3>
                <?php if (isset($error)) echo "<div class='alert alert-danger text-center'>$error</div>"; ?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="firstName" class="form-control" required placeholder="First Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lastName" class="form-control" required placeholder="Last Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-custom w-100">REGISTER</button>
                    <p class="text-center mt-3">or use your Gmail for registration</p>
                    <button class="btn btn-outline-dark w-100">Continue with Google</button>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.querySelector('input[name="password"]');
        const toggleButton = document.createElement("span");

        toggleButton.innerHTML = '<i class="bi bi-eye"></i>'; // Bootstrap eye icon
        toggleButton.style.position = "absolute";
        toggleButton.style.right = "10px";
        toggleButton.style.top = "50%";
        toggleButton.style.transform = "translateY(-50%)";
        toggleButton.style.cursor = "pointer";

        const wrapper = document.createElement("div");
        wrapper.style.position = "relative";
        passwordInput.parentNode.insertBefore(wrapper, passwordInput);
        wrapper.appendChild(passwordInput);
        wrapper.appendChild(toggleButton);

        toggleButton.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>'; // Change to eye-slash icon
            } else {
                passwordInput.type = "password";
                toggleButton.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });
    });
</script>

<!-- Include Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


</body>

</html>