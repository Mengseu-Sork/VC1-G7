<?php
require 'Router.php';
require_once 'Controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
<<<<<<< HEAD
require 'Controllers/ProductController.php';
=======
require_once 'Controllers/AdminController.php';
>>>>>>> 114b77203b1b04157aaeb5dc5d8f54ce0bc66422


$routes = new Router();

$routes->get('/', [DashboardController::class, 'index']);


$routes->get('/admin', [AdminController::class, 'index']);
$routes->get('/admin/create', [AdminController::class, 'create']);
$routes->post('/admin/store', [AdminController::class, 'store']);
$routes->get('/admin/edit', [AdminController::class, 'edit']);
$routes->put('/admin/update', [AdminController::class, 'update']);
$routes->delete('/admin/delete', [AdminController::class, 'destroy']);

$routes->get('/user', [UserController::class, 'index']);
$routes->get('/user/create', [UserController::class, 'create']);
$routes->post('/user/store', [UserController::class, 'store']);
$routes->get('/user/edit', [UserController::class, 'edit']);
$routes->put('/user/update', [UserController::class, 'update']);
$routes->delete('/user/delete', [UserController::class, 'destroy']);
$routes->get('/user/show', [UserController::class, 'show']);

$routes->get('/products', [ProductController::class, 'index']);
$routes->get('/products/product_list', [ProductController::class, 'index']);
$routes->get('/products/create', [ProductController::class, 'create']);
$routes->get('/products/edite', [ProductController::class, 'edite']);
$routes->delete('/products/delete', [ProductController::class, 'delete']);

$routes->dispatch();
