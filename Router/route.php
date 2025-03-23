<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/CategoryController.php';
require 'Controllers/ProductController.php';
require 'Controllers/AdminController.php';
require 'Controllers/ShowproductController.php';
require_once 'Controllers/OrderController.php';


$routes = new Router();

// dashboard
$routes->get('/', [DashboardController::class, 'index']);

// Homepage
$routes->get('/pages', [ShowproductController::class, 'show']);

$routes->get('/auth/signup', [AdminController::class, 'signup']);
$routes->post('/signup', [AdminController::class, 'signup']);
$routes->post('/auth/signout', [AdminController::class, 'signup']);

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
$routes->post('/products/update/{id}', [ProductController::class, 'update']);
$routes->delete('/products/delete', [ProductController::class, 'delete']);
// Make sure this line exists in your routes:
$routes->get('/products/details', [ProductController::class, 'show']);

    
// $routes->get('/products_list', [ProductController::class, 'index']);

$routes->get('/categories', [CategoryController::class, 'index']);
// $routes->get('/categories/create', [CategoryController::class, 'create']);
// $routes->post('/categories/store', [CategoryController::class, 'store']);
// $routes->get('/categories/edit/{id}', [CategoryController::class, 'edit']);
// $routes->post('/categories/update/{id}', [CategoryController::class, 'update']);
// $routes->get('/categories/delete/{id}', [CategoryController::class, 'delete']);

$routes->get('/order', [OrderController::class, 'index']);
$routes->get('/order/view', [OrderController::class, 'view']);  
$routes->delete('/order/delete', [OrderController::class, 'delete']);

$routes->dispatch();
