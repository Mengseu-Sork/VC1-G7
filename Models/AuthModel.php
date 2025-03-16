<?php
// require_once "Databases/database.php";

// class AuthModel
// {
//     private $db;

//     public function __construct()
//     {
//         $this->db = new Database();
//     }

//     public function login($email, $password)
//     {
//         $stmt = $this->db->query("SELECT * FROM users WHERE email = ?", [$email]);
//         $user = $stmt->fetch(PDO::FETCH_ASSOC);

//         if ($user && password_verify($password, $user["password"])) {
//             return $user;
//         }
//         return false;
//     }

//     public function register($email, $password)
//     {
//         $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
//         return $this->db->query("INSERT INTO users (email, password) VALUES (?, ?)", [$email, $hashedPassword]);
//     }
// }
?>
