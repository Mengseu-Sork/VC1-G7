<?php
require_once 'Databases/Database.php';
class ReportModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }
    public function getAllReports() {
        $query = "SELECT * FROM reports_analytics";
        $result = $this->db->query($query);
        return $result->fetchAll();
    }
}