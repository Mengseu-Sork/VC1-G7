<?php
require 'Router.php';
require 'Controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require 'Controllers/ProductController.php';


$routes = new Router();

$routes->get('/', [DashboardController::class, 'index']);

$routes->get('/user', [UserController::class, 'index']);
$routes->get('/user/create', [UserController::class, 'create']);
$routes->post('/user/store', [UserController::class, 'store']);
$routes->get('/user/edit', [UserController::class, 'edit']);
$routes->put('/user/update', [UserController::class, 'update']);
$routes->delete('/user/delete', [UserController::class, 'destroy']);
$routes->get('/user/show', [UserController::class, 'show']);

$routes->get('/products', [ProductController::class, 'index']);
$routes->get('/products/product_list', [ProductController::class, 'index']);
$routes->get('/products/create', [UserController::class, 'create']);
$routes->delete('/products/delete', [ProductController::class, 'delete']);

$routes->dispatch();
