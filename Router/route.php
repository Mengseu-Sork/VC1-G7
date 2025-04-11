<?php

require_once 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/CategoryController.php';
require_once 'Controllers/ProductController.php';
require_once 'Controllers/ShowproductController.php';
require_once 'Controllers/OrderController.php';
require_once 'Controllers/AuthController.php';
require_once 'Controllers/StockController.php';
require_once 'Controllers/ProfileController.php';



$routes = new Router();

// dashboard
$routes->get('/Dashboard', [DashboardController::class, 'index']);

//profile
$routes->get('/profile/profile', [ProfileController::class, 'profile']);
$routes->get('/profile/editProfile', [ProfileController::class, 'editProfile']);
$routes->put('/profile/updateProfile', [ProfileController::class, 'updateProfile']);

// Authentication routes
$routes->get('/', [AuthController::class, 'login']);
$routes->post('/auth/login', [AuthController::class, 'login']);
$routes->get('/auth/register', [AuthController::class, 'register']);
$routes->post('/auth/register', [AuthController::class, 'register']);
$routes->get('/auth/logout', [AuthController::class, 'logout']);

// Homepage
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
$routes->get('/products/details', [ProductController::class, 'show']);
$routes->get('/products/prosuct_ratings', [ProductController::class, 'ratings']);

$routes->get('/categories', [CategoryController::class, 'index']);
$routes->get('/categories/create', [CategoryController::class, 'create']);
$routes->post('/categories/store', [CategoryController::class, 'store']);
$routes->get('/categories/edit', [CategoryController::class, 'edit']);
$routes->put('/categories/update', [CategoryController::class, 'update']);
$routes->get('/categories/delete', [CategoryController::class, 'destroy']);


// order
$routes->get('/orders', [OrderController::class, 'index']);
// $routes->get('/orders/create', [OrderController::class, 'create']);
// $routes->post('/orders/store', [OrderController::class, 'store']);
// $routes->get('/orders/edit/{id}', [OrderController::class, 'edit']);
// $routes->post('/orders/update/{id}', [OrderController::class, 'update']);
// $routes->delete('/orders/delete', [OrderController::class, 'delete']);
// $routes->get('/orders/show', [OrderController::class, 'show']);

$routes->dispatch();
$routes->get('/pages/order', [OrderController::class, 'index']); 
$routes->post('/products/order', [OrderController::class, 'process']);

//Stock
$routes->get('/stock/stock', [StockController::class, 'index']);
$routes->get('/stock/create', [StockController::class, 'create']);
$routes->post('/stock/store', [StockController::class, 'store']);


$routes->dispatch();