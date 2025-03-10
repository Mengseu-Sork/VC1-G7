<?php
require_once 'Databases/database.php';
class AdminModel
{
    private $pdo;
    function __construct()
    {
        $this->pdo = new Database();
    }
    function getAdmins()
    {
        $admins = $this->pdo->query('SELECT * From admins ORDER BY id DESC');
        return $admins->fetchAll(PDO::FETCH_ASSOC);
    }

    function createAdmin($data)
    {
        $this->pdo->query("INSERT INTO admins (username, profile, email, password_hash) VALUES (:username, :profile, :email,  :password_hash)", 
        [                
            'username' => $data['name'],
            'profile' => $data['profile'],
            'email' => $data['email'],
            'password_hash' => $data['password_hash'],
        ]);
    }

    function getAdmin($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM admins WHERE id = :id", ['id' => $id]);
        return $stmt->fetch();
    }
    function updateAdmin($id, $data)
    {
        $this->pdo->query("UPDATE admins SET username = :username, profile = :profile, email = :email,  password_hash = :password_hash WHERE id = :id",
        [
            'name' => $data['name'],
            'profile' => $data['profile'],
            'email' => $data['email'],
            'password_hash' => $data['password_hash'],
            'id' => $id
        ]
        );
    }
    
    function deleteAdmin($id)
    {
        $this->pdo->query("DELETE FROM admins WHERE id = :id", ['id' => $id]);
    }
}
