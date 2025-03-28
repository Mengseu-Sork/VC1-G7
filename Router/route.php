<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/CategoryController.php';
require 'Controllers/ProductController.php';
require 'Controllers/ShowproductController.php';
require 'Controllers/StockController.php';


$routes = new Router();

// dashboard
$routes->get('/', [DashboardController::class, 'index']);

// Homepage
$routes->get('/pages', [ShowproductController::class, 'index']);
$routes->get('/pages/stock', [StockController::class, 'index']);
$routes->get('/pages/detail', [StockController::class, 'show']);

$routes->get('/pages', [ShowproductController::class, 'index']);
$routes->get('/pages/products', [ShowproductController::class, 'index']);
$routes->get('/pages/details', [ShowproductController::class, 'show']);
$routes->get('/pages/prosuct_ratings', [ShowproductController::class, 'ratings']);

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
$routes->delete('/products/details', [ProductController::class, 'show']);
$routes->get('/products/prosuct_ratings', [ProductController::class, 'ratings']);

$routes->get('/categories', [CategoryController::class, 'index']);
$routes->get('/categories/create', [CategoryController::class, 'create']);
$routes->post('/categories/store', [CategoryController::class, 'store']);
$routes->get('/categories/edit', [CategoryController::class, 'edit']);
$routes->post('/categories/update', [CategoryController::class, 'update']);
$routes->get('/categories/delete', [CategoryController::class, 'destroy']);

// // Add notification routes
// $routes->get('/notifications', [NotificationController::class, 'getNotifications']);
// $routes->post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead']);
// $routes->post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);

$routes->dispatch();

