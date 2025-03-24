<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/CategoryController.php';
require 'Controllers/ProductController.php';
require 'Controllers/AdminController.php';
require 'Controllers/ShowproductController.php';
require 'Controllers/ShowuserController.php';


$routes = new Router();

// dashboard
$routes->get('/', [DashboardController::class, 'index']);

// Homepage
$routes->get('/pages', [ShowproductController::class, 'show']);

// $routes->get('/auth/signup', [AdminController::class, 'signup']);
// $routes->post('/signup', [AdminController::class, 'signup']);
// $routes->post('/auth/signout', [AdminController::class, 'signup']);

// user
$routes->get('/user', [UserController::class, 'index']);
$routes->get('/user/create', [UserController::class, 'create']);
$routes->post('/user/store', [UserController::class, 'store']);
$routes->get('/user/edit', [UserController::class, 'edit']);
$routes->put('/user/update', [UserController::class, 'update']);
$routes->delete('/user/delete', [UserController::class, 'destroy']);
$routes->get('/user/show', [UserController::class, 'show']);

// products
$routes->get('/products', [ProductController::class, 'index']);
$routes->get('/products/product_list', [ProductController::class, 'index']);
$routes->get('/products/create', [ProductController::class, 'create']);
$routes->post('/products/store', [ProductController::class, 'store']);
$routes->get('/products/edit', [ProductController::class, 'edit']);
$routes->post('/products/update', [ProductController::class, 'update']);
$routes->get('/products/delete', [ProductController::class, 'delete']); 
// Make sure this line exists in your routes:
$routes->get('/products/details', [ProductController::class, 'show']);

$routes->get('/categories', [CategoryController::class, 'index']);


// order
$routes->get('/orders', [OrderController::class, 'index']);
// $routes->get('/orders/create', [OrderController::class, 'create']);
// $routes->post('/orders/store', [OrderController::class, 'store']);
// $routes->get('/orders/edit/{id}', [OrderController::class, 'edit']);
// $routes->post('/orders/update/{id}', [OrderController::class, 'update']);
// $routes->delete('/orders/delete', [OrderController::class, 'delete']);
// $routes->get('/orders/show', [OrderController::class, 'show']);

$routes->dispatch();

