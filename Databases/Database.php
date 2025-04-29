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
            $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            error_log("Database connection established successfully");
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw $e; // Re-throw to allow proper error handling
        }
    }

    public function query($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage() . " - SQL: " . $sql);
            throw $e; // Re-throw to allow proper error handling
        }
    }
    
    public function getConnection()
    {
        return $this->pdo;
    }

    public function closeConnection()
    {
        $this->pdo = null;
    }
    
    // Check if a transaction is active
    public function isTransactionActive() {
        try {
            return $this->pdo->inTransaction();
        } catch (PDOException $e) {
            error_log("Error checking transaction status: " . $e->getMessage());
            return false;
        }
    }
}
?>
