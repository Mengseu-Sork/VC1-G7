<?php
class Database
{
    private $pdo;

    public function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "coffeeshop"; // Your database name

        try {
            // Create PDO connection
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = [])
    {
        try {
            // Prepare and execute SQL query
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query Error: " . $e->getMessage());
        }
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();

    }
    
}

?>
