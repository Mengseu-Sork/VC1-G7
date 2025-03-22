<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
// require_once 'Controllers/AuthController.php';
require 'Controllers/ProductController.php';
require 'Controllers/AdminController.php';
require 'Controllers/ShowproductController.php';
require 'Controllers/ShowuserController.php';


$routes = new Router();

// dashboard
$routes->get('/', [DashboardController::class, 'index']);

// Homepage
$routes->get('/pages', [ShowproductController::class, 'show']);
// $routes->get('/', [ShowuserController::class, 'user']);


// $routes->get('/signin', [AuthController::class, 'login']);
$routes->get('/auth/signup', [AdminController::class, 'signup']);
$routes->post('/signup', [AdminController::class, 'signup']);


// $routes->post('/Dashboard', [DashboardController::class, 'store']);





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
$routes->delete('/products/delete', [ProductController::class, 'delete']);

$routes->dispatch();
