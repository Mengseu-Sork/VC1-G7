<?php
require_once 'Databases/Database.php';

// ProductModel.php
class AddProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
}
?>
