<?php
require_once 'Databases/database.php';

class UserModel
{
    private $pdo;

    function __construct()
    {
        $this->pdo = new Database();
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