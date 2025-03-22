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
        return $this->pdo->query('SELECT * FROM users ORDER BY id DESC')->fetchAll();
    }

    public function getUserByEmail($email)
{
    $stmt = $this->pdo->query("SELECT * FROM users WHERE email = ?", [$email]);
    return $stmt->fetch();
}
    function createUser($data)
    {
        return $this->pdo->query("INSERT INTO users (image, FirstName, LastName, email, password) 
                                  VALUES (:image, :FirstName, :LastName, :email, :password)", [
            'image' => $data['image'],
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
    }

    function getUser($id)
    {
        return $this->pdo->query("SELECT * FROM users WHERE id = :id", ['id' => $id])->fetch();
    }
    
    function updateUser($id, $data)
    {
        return $this->pdo->query("UPDATE users SET image = :image, FirstName = :FirstName, LastName = :LastName, 
                                  email = :email, password = :password WHERE id = :id", [
            'image' => $data['image'],
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'id' => $id
        ]);
    }
    function deleteUser($id)
    {
        return $this->pdo->query("DELETE FROM users WHERE id = :id", ['id' => $id]);
    }

    public function show($id)
    {
        $sql = "SELECT users.id,users.image, users.FirstName, users.LastName, users.email, users.password FROM users WHERE users.id = :id";
        $stmt = $this->pdo->query($sql, [':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }   
}
