<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/HomeController.php';
require_once 'Controllers/AuthController.php';
require 'Controllers/ProductController.php';
require 'Controllers/OrderHistoryController.php';


$routes = new Router();

// Homepage
$routes->get('/', action: [HomeController::class, 'index']);


$routes->get('/signin', [AuthController::class, 'login']);


// dashboard
$routes->get('/Dashboard', [DashboardController::class, 'index']);

// user 

$routes->get('/user', [UserController::class, 'index']);
$routes->get('/user/create', [UserController::class, 'create']);
$routes->post('/user/store', [UserController::class, 'store']);
$routes->get('/user/edit', [UserController::class, 'edit']);
$routes->put('/user/update', [UserController::class, 'update']);
$routes->delete('/user/delete', [UserController::class, 'destroy']);
$routes->get('/user/show', [UserController::class, 'show']);


$routes->get('/products', [ProductController::class, 'index']);
$routes->get('/products/product_list', [ProductController::class, 'index']);
$routes->get('/products/product_nut', [ProductController::class, 'nut']);
$routes->get('/products/product_flour', [ProductController::class, 'flour']);
$routes->get('/products/create', [ProductController::class, 'create']);
$routes->post('/products/store', [ProductController::class, 'store']);
$routes->get('/products/edit', [ProductController::class, 'edit']);
$routes->put('/products/update', [ProductController::class, 'update']);
$routes->delete('/products/delete', [ProductController::class, 'delete']);

// orders
$routes->get('/orders', [OrderHistoryController::class, 'index']);
// $routes->delete('/orders/delete', [OrderHistoryController::class, 'delete']);

$routes->dispatch();
