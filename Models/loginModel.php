<?php
require_once "Databases/Database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

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
            header("Location: ../Views/pages/home.php");
            exit;
        } else {
            echo "<script>alert('Error registering user. Try again!');</script>";
        }
    }
}


class LoginModel
{
    private $pdo;
    function __construct()
    {
        $this->pdo = new Database();
    }
    function getUsers()
    {
        $users = $this->pdo->query('SELECT * From users ORDER BY user_id DESC');
        return $users->fetchAll(PDO::FETCH_ASSOC);
    }
    

    function createUser($data)
    {
        $this->pdo->query("INSERT INTO users (FisrtName, LastName, email, password, image) VALUES (:FisrtName, :LastName, :email, :password, :image)", 
        [                
            'FisrtName' => $data['FisrtName'],
            'LastName' => $data['LastName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'image' => $data['image'],
        ]);
    }

    function getUser($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM users WHERE user_id = :user_id", ['user_id' => $id]);
        return $stmt->fetch();
    }
    function updateUser($id, $data)
    {
        $this->pdo->query("UPDATE users SET  FisrtName = :FisrtName, LastName = :LastName, email = :email, password = :password, image = :image WHERE user_id = :user_id",
        [
            'FisrtName' => $data['FisrtName'],
            'LastName' => $data['LastName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'image' => $data['image'],
            'user_id' => $id
        ]
        );
    }
    
    function deleteUser($id)
    {
        $this->pdo->query("DELETE FROM users WHERE user_id = :user_id", ['user_id' => $id]);
    }   
}

?>