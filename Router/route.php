<?php
require 'Router.php';
require 'Controllers/UserController.php';
require_once 'Controllers/DashboardController.php';


$routes = new Router();

$routes->get('/auth', [DashboardController::class, 'index']);

$routes->get('/user', [UserController::class, 'index']);
$routes->get('/user/create', [UserController::class, 'create']);
$routes->post('/user/store', [UserController::class, 'store']);
$routes->get('/user/edit', [UserController::class, 'edit']);
$routes->put('/user/update', [UserController::class, 'update']);
$routes->delete('/user/delete', [UserController::class, 'destroy']);
$routes->get('/user/show', [UserController::class, 'show']);


$routes->dispatch();
