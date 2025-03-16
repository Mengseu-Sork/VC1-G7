<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/HomeController.php';
// require_once 'Controllers/AuthController.php';



$routes = new Router();

// Homepage
$routes->get('/', [HomeController::class, 'index']);


// $routes->get('/signin', [AuthController::class, 'login']);

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


$routes->dispatch();
