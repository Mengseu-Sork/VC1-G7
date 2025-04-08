
<?php 
require("Router/route.php");
// index.php or router file
if ($_GET['controller'] === 'transactions') {
    require_once 'Controllers/TransactionController.php';
    $controller = new TransactionController();

    switch ($_GET['action'] ?? 'index') {
        case 'store':
            $controller->store();
            break;
        case 'delete':
            $controller->delete();
            break;
        default:
            $controller->index();
            break;
    }
}
