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
<<<<<<<<< Temporary merge branch 1
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
=========
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
>>>>>>>>> Temporary merge branch 2
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
<<<<<<<<< Temporary merge branch 1
            die("Query Error: " . $e->getMessage());
        }
    }
=========
            die("Query failed: " . $e->getMessage());
        }
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }
>>>>>>>>> Temporary merge branch 2
}
?>
