<?php
require_once 'Databases/Database.php';

class ProfileModel
{
    private $pdo;

    function __construct()
    {
        $this->pdo = new Database();
    }


public function getUserProfile($id) {
        $sql = "SELECT id, image, FirstName, LastName, email, phone, role 
                FROM admins 
                WHERE id = :id";
        return $this->pdo->query($sql, [':id' => $id])->fetch(PDO::FETCH_ASSOC);
    }
}