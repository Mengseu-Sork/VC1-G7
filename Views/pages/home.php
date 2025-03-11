<?php
require_once '../layout/navbarPages/header_user.php';
require_once '../layout/navbarPages/nav_user.php';
require_once '../layout/navbarPages/footer_user.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: signin.php");
    exit;
}

$user = $_SESSION['user'];
?>
