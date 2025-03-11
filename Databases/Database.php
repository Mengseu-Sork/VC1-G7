<?php
// Ensure the class is not declared multiple times
if (!class_exists('Database')) {
    class Database
    {
        private static $instance = null;
        private $pdo;

        // Private constructor to prevent multiple instances
        private function __construct()
        {
            $servername = "localhost";
            $username = "root";  // Change if needed
            $password = "";      // Change if needed
            $dbname = "coffeeshop";

            try {
                $this->pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("❌ Connection failed: " . $e->getMessage());
            }
        }

        // Get single instance of Database class
        public static function getInstance()
        {
            if (self::$instance == null) {
                self::$instance = new Database();
            }
            return self::$instance;
        }

        // Get PDO connection
        public function getConnection()
        {
            return $this->pdo;
        }
    }
}
?>
