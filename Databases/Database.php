<?php
// Ensure the class is not declared multiple times
if (!class_exists('Database')) {
    class Database
    {
        private static $instance = null;
        private $pdo;

        private function __construct($servername, $dbname, $username, $password)
        {
            try {
                $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        public static function getInstance($servername, $dbname, $username, $password)
        {
            if (self::$instance === null) {
                self::$instance = new self($servername, $dbname, $username, $password);
            }
            return self::$instance;
        }

        public function query($sql, $params = [])
        {
            try {
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
    }
}
?>
