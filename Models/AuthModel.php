<?php
require_once 'Databases/Database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = new Database();
    }

    public function register($firstName, $lastName, $email, $phone, $password, $role = 'employee') {
        $adminExists = $this->checkAdminExists();
        
        if ($role === 'admin' && $adminExists) {
            $role = 'employee';
        }
        
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO admins (FirstName, LastName, email, phone, password, role) 
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
        $sql = "SELECT * FROM admins WHERE email = :email";
        $params = [':email' => $email];
        $stmt = $this->pdo->query($sql, $params);
        $user = $stmt->fetch();

        return $user;
    }

    // Check if an admin already exists
    private function checkAdminExists() {
        $sql = "SELECT COUNT(*) as admin_count FROM admins WHERE role = 'admin'";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch();
        
        return $result['admin_count'] > 1;
    }

    // Update login time
    public function updateLoginTime($userId) {
        $sql = "UPDATE admins SET last_login = NOW() WHERE id = :id";
        $params = [':id' => $userId];
        return $this->pdo->query($sql, $params);
    }
    
    // Set user as active or inactive
    public function setUserActive($userId, $status) {
        $sql = "UPDATE admins SET active = :status WHERE id = :id";
        $params = [
            ':status' => $status,
            ':id' => $userId
        ];
        return $this->pdo->query($sql, $params);
    }

    // Get user login history
    public function getLoginHistory($userId) {
        $sql = "SELECT last_login FROM admins WHERE id = :id";
        $params = [':id' => $userId];
        $stmt = $this->pdo->query($sql, $params);
        return $stmt->fetch();
    }
}
?>