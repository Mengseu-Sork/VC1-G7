<?php
class Database
{
    private $pdo;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "coffeeshop";

        try {
<<<<<<< HEAD
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
=======
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
>>>>>>> 114b77203b1b04157aaeb5dc5d8f54ce0bc66422
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
<<<<<<< HEAD
            die("Query failed: " . $e->getMessage());
        }
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }
=======
            die("Query Error: " . $e->getMessage());
        }
    }
>>>>>>> 114b77203b1b04157aaeb5dc5d8f54ce0bc66422
}
?>
