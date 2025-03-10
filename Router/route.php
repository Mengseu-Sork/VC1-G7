<?php
require 'Router.php';
require_once 'Controllers/UserController.php';
require_once 'Controllers/DashboardController.php';
require_once 'Controllers/AdminController.php';


$routes = new Router();
$routes -> get('/auth/signin', [AdminController::class, 'signin']);
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


$routes->dispatch();
