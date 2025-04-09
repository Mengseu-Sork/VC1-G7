<?php
require_once 'Databases/Database.php';

class UserModel
{
    private $pdo;

    function __construct()
    {
        $this->pdo = new Database();
    }

    function getUsers()
    {
        return $this->pdo->query('SELECT * FROM admins ORDER BY id DESC')->fetchAll();
    }

    public function getUserByEmail($email)
    {
    $stmt = $this->pdo->query("SELECT * FROM admins WHERE email = ?", [$email]);
    return $stmt->fetch();
    }


    function createUser($data)
    {
        $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);
        $role = isset($data['role']) ? $data['role'] : 'employee';
    
        $sql = "INSERT INTO admins (image, FirstName, LastName, email, phone, password, role) 
                VALUES ('{$data['image']}', '{$data['FirstName']}', '{$data['LastName']}', '{$data['email']}', 
                        '{$data['phone']}', '$passwordHash', '$role')";
    
        return $this->pdo->query($sql);
    }

    
    function getUser($id)
    {
        $sql = "SELECT * FROM admins WHERE id = :id";
        return $this->pdo->query($sql, ['id' => $id])->fetch(PDO::FETCH_ASSOC);
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


    function deleteUser($id)
    {
        return $this->pdo->query("DELETE FROM admins WHERE id = :id", ['id' => $id]);
    }

    public function show($id)
    {
        $sql = "SELECT admins.id,admins.image, admins.FirstName, admins.LastName, admins.email, admins.phone, admins.role, admins.password FROM admins WHERE admins.id = :id";
        $stmt = $this->pdo->query($sql, [':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }   
    
}
