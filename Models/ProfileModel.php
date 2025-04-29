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

    function updateUser($id, $data)
    {
        return $this->pdo->query("UPDATE admins SET image = :image, FirstName = :FirstName, LastName = :LastName, 
                                  email = :email, phone = :phone, role = :role, password = :password WHERE id = :id", [
            'image' => $data['image'],
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'id' => $id
        ]);
    }
}