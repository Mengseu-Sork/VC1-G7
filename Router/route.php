<?php
require 'Router.php';
require_once 'controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/HomeController.php';


$routes = new Router();

// Homepage
$routes->get('/', [HomeController::class, 'index']);

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
