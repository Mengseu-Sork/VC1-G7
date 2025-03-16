<?php
// require_once  "Models/AuthModel.php";
// session_start();

// class AuthController
// {
//     private $authModel;

//     public function __construct()
//     {
//         $this->authModel = new AuthModel();
//     }

//     public function login()
//     {
//         if ($_SERVER["REQUEST_METHOD"] == "POST") {
//             $email = $_POST["email"];
//             $password = $_POST["password"];

//             $user = $this->authModel->login($email, $password);
//             if ($user) {
//                 $_SESSION["user"] = $user["email"];
//                 header("Location: views/pages/home.php");
//                 exit();
//             } else {
//                 echo "Invalid credentials.";
//             }
//         }
//         require "views/auth/signin.php";
//     }

//     public function register()
//     {
//         if ($_SERVER["REQUEST_METHOD"] == "POST") {
//             $email = $_POST["email"];
//             $password = $_POST["password"];

//             $this->authModel->register($email, $password);
//             header("Location: /signin");
//         }
//         require "views/auth/register.php";
//     }

//     public function logout()
//     {
//         session_destroy();
//         header("Location: /signout");
//     }
// }
?>
