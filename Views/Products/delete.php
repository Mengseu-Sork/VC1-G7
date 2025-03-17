<?php
require_once 'Databases/Database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $db = new Database();

    $stmt = $db->query("SELECT * FROM product WHERE id = :id", ['id' => $id]);
    if ($stmt->fetch()) {
        $db->query("DELETE FROM product WHERE id = :id", ['id' => $id]);
        echo "Product deleted successfully";
    } else {
        echo "Product not found";
    }
}
?>

