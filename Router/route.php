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
require_once 'Controllers/PaymentController.php';



$routes = new Router();

// dashboard
$routes->get('/Dashboard', [DashboardController::class, 'index']);

//profile
$routes->get('/profile', [ProfileController::class, 'profile']);
$routes->get('/profile/editProfile', [ProfileController::class, 'editProfile']);
$routes->post('/profile/updateProfile', [ProfileController::class, 'updateProfile']);

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
$routes->post('/user/update', [UserController::class, 'update']);
$routes->post('/user/delete', [UserController::class, 'destroy']);
$routes->get('/user/show', [UserController::class, 'show']);

$routes->get('/payments/payment', [PaymentController::class, 'payment']);
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

//category
$routes->get('/categories', [CategoryController::class, 'index']);
$routes->get('/categories/create', [CategoryController::class, 'create']);
$routes->post('/categories/store', [CategoryController::class, 'store']);
$routes->get('/categories/edit', [CategoryController::class, 'edit']);
$routes->put('/categories/update', [CategoryController::class, 'update']);
$routes->get('/categories/delete', [CategoryController::class, 'destroy']);

//order
$routes->post('/order/process', [OrderController::class, 'process']);
$routes->post('/orderHistory/process', [OrderController::class, 'process']);
$routes->get('/orders/orderHistory', [OrderController::class, 'index']);
$routes->get('/pages/order_summary', [OrderController::class, 'viewOrder']);

// payment

//Stock
$routes->get('/stock', [StockController::class, 'index']);
$routes->get('/stock/create', [StockController::class, 'create']);
$routes->post('/stock/store', [StockController::class, 'store']);
$routes->get('/stock/edit', [StockController::class, 'edit']);
$routes->post('/stock/update', [StockController::class, 'update']);
$routes->post('/stock/delete', [StockController::class, 'delete']);


$routes->dispatch();