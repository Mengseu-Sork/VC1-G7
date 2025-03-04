<?php
require_once "Router.php";
require_once "Controllers/BaseController.php";
// require_once "Database/Database.php";
require_once "Controllers/ProductController.php";


// $route = new Router();
$route->get("/", [ProductController::class, 'Product']);

$route->route();