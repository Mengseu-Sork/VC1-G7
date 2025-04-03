<?php
require_once 'Databases/Database.php';

class ShowuserModel
{
    private $pdo;

    function __construct()
    {
        $this->pdo = new Database();
    }

    function getUsers()
    {
        return $this->pdo->query('SELECT * FROM users ORDER BY id DESC')->fetchAll();
    }
}
