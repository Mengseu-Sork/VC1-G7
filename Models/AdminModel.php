<?php
require_once "Databases/Database.php";

class AdminModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new Database();
    }

    public function login($email, $password)
    {
        $stmt = $this->pdo->query("SELECT * FROM admins WHERE email = ?", [$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin["password_hash"])) {
            return $admin;
        } 
        return false;

    }
}
?>