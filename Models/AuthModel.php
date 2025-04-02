<?php
require_once 'Databases/Database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database();
    }

    public function register($firstName, $lastName, $email, $phone, $password, $role = 'user') {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (FirstName, LastName, email, phone, password, role) 
                VALUES (:firstName, :lastName, :email, :phone, :password, :role)";
        $params = [
            ':firstName' => $firstName,
            ':lastName'  => $lastName,
            ':email'     => $email,
            ':phone'     => $phone,
            ':password'  => $hashed_password,
            ':role'      => $role
        ];
        return $this->pdo->query($sql, $params);
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $params = [':email' => $email];
        $stmt = $this->pdo->query($sql, $params);
        $user = $stmt->fetch();

       return $user;
    }
}
?>
