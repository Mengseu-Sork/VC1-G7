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
        $users = $this->pdo->query('SELECT * From users ORDER BY user_id DESC');
        return $users->fetchAll(PDO::FETCH_ASSOC);
    }
    

    function createUser($data)
    {
        $this->pdo->query("INSERT INTO users (FisrtName, LastName, email, password, image) VALUES (:FisrtName, :LastName, :email, :password, :image)", 
        [                
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'image' => $data['image'],
        ]);
    }

    function getUser($id)
    {
        echo "Fetching user with ID: $id";
        $stmt = $this->pdo->query("SELECT * FROM users WHERE user_id = :user_id", ['user_id' => $id]);
        return $stmt->fetch();
    }
    
    function updateUser($id, $data)
    {
        $this->pdo->query("UPDATE users SET  FisrtName = :FisrtName, LastName = :LastName, email = :email, password = :password, image = :image WHERE user_id = :user_id",
        [
            'FisrtName' => $data['FisrtName'],
            'LastName' => $data['LastName'],
            'email' => $data['email'],
            'password' => $data['password'],
            'image' => $data['image'],
            'user_id' => $id
        ]
        );
    }
    
    function deleteUser($id)
    {
        $this->pdo->query("DELETE FROM users WHERE user_id = :user_id", ['user_id' => $id]);
    }   
}
