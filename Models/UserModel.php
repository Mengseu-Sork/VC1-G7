<?php
require_once 'Databases/database.php';
class UserModel
{
    private $pdo;
    function __construct()
    {
        $this->pdo = new Database();
    }
    function getUsers()
    {
        $users = $this->pdo->query('SELECT * From users ORDER BY id DESC');
        return $users->fetchAll(PDO::FETCH_ASSOC);
    }

    function createUser($data)
    {
        $this->pdo->query("INSERT INTO users (profile, name, email, password) VALUES (:profile, :name, :email, :password)", 
        [                
            'profile' => $data['profile'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    function getUser($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM users WHERE id = :id", ['id' => $id]);
        return $stmt->fetch();
    }
    function updateUser($id, $data)
    {
        $this->pdo->query("UPDATE users SET profile = :profile, name = :name, email = :email, password = :password WHERE id = :id",
        [
            'profile' => $data['profile'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'id' => $id
        ]
        );
    }
    
    function deleteUser($id)
    {
        $this->pdo->query("DELETE FROM users WHERE id = :id", ['id' => $id]);
    }

    public function show($id)
    {
        $sql = "SELECT users.id,users.profile, users.name, users.email, users.password FROM users WHERE users.id = :id";
        $stmt = $this->pdo->query($sql, [':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }    
}
