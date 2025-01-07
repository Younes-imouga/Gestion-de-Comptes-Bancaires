<?php
require_once '../core/router.php';
require_once '../core/route.php';

require_once '../config/db.php';
require_once '../core/BaseController.php';
require_once '../controllers/AdminController.php';
require_once '../controllers/ClientController.php';
require_once '../controllers/AuthController.php';

$router = new Router();
Route::setRouter($router);

Route::get("/register", [AuthController::class, 'displaySignUp']);
Route::post("/register", [AuthController::class, 'handleRegister']);
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);