<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/CategoryController.php';
require 'Controllers/ProductController.php';
// require 'Controllers/AdminController.php';
require 'Controllers/ShowproductController.php';
require 'Controllers/ShowuserController.php';


$routes = new Router();

// dashboard
$routes->get('/', [DashboardController::class, 'index']);

// Homepage
$routes->get('/pages', [ShowproductController::class, 'show']);

// $routes->get('/auth/login', [AdminController::class, 'login']);
// $routes->post('/auth/login', [AdminController::class, 'login']);
// $routes->post('/auth/logout', [AdminController::class, 'logout']);

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
$routes->get('/products/create', [ProductController::class, 'create']);
$routes->post('/products/store', [ProductController::class, 'store']);
$routes->get('/products/edit', [ProductController::class, 'edit']);
$routes->post('/products/update', [ProductController::class, 'update']);
$routes->delete('/products/delete', [ProductController::class, 'delete']);

    
// $routes->get('/products_list', [ProductController::class, 'index']);

$routes->get('/categories', [CategoryController::class, 'index']);
// $routes->get('/categories/create', [CategoryController::class, 'create']);
// $routes->post('/categories/store', [CategoryController::class, 'store']);
// $routes->get('/categories/edit/{id}', [CategoryController::class, 'edit']);
// $routes->post('/categories/update/{id}', [CategoryController::class, 'update']);
// $routes->get('/categories/delete/{id}', [CategoryController::class, 'delete']);

$routes->dispatch();
