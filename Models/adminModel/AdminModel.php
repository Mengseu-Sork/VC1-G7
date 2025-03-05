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
        $Admins = $this->pdo->query('SELECT * From admins ORDER BY id DESC');
        return $Admins->fetchAll(PDO::FETCH_ASSOC);
    }

    function createAdmin($data)
    {
        $this->pdo->query("INSERT INTO admins (profile, name, email, password) VALUES (:profile, :name, :email, :password)", 
        [                
            'profile' => $data['profile'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    function getAdmin($id)
    {
        $stmt = $this->pdo->query("SELECT * FROM admins WHERE id = :id", ['id' => $id]);
        return $stmt->fetch();
    }
    function updateAdmin($id, $data)
    {
        $this->pdo->query("UPDATE admins SET profile = :profile, name = :name, email = :email, password = :password WHERE id = :id",
        [
            'profile' => $data['profile'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'id' => $id
        ]
        );
    }
    
    function deleteAdmin($id)
    {
        $this->pdo->query("DELETE FROM admins WHERE id = :id", ['id' => $id]);
    }
}
//     public function show($id)
//     {
//         $sql = "SELECT admins.id,Admins.profile, Admins.name, Admins.email, Admins.password FROM Admins WHERE Admins.id = :id";
//         $stmt = $this->pdo->query($sql, [':id' => $id]);
//         return $stmt->fetch(PDO::FETCH_ASSOC);
//     }    
// }
