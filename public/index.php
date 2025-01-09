<?php
session_start();
require_once '../core/router.php';
require_once '../core/route.php';

require_once '../config/db.php';
require_once '../core/BaseController.php';
require_once '../controllers/AdminController.php';
require_once '../controllers/ClientController.php';
require_once '../controllers/AuthController.php';

$router = new Router();
Route::setRouter($router);

if (!isset($_SESSION['user_logged_in_id'])) { 
    Route::get("/", [AuthController::class, 'displayLogin']);
} else {
    if (isset($_SESSION['is_admin'])) {
        Route::get("/", [AdminController::class, 'displayDashboardAdmin']);
    }else{
        Route::get("/", [ClientController::class, 'displayDashboard']);
    }
}

Route::get("/login", [AuthController::class, 'displayLogin']);
Route::post("/login", [AuthController::class, 'handleLogin']);

Route::get("/dashboard", [ClientController::class, 'displayDashboard']);
Route::post("/alimenter", [ClientController::class, 'handleAlimentation']);

Route::get("/virement", [ClientController::class, 'displayTransfer']);
Route::post("/transfer", [ClientController::class, 'handleTransfer']);

Route::get("/account", [ClientController::class, 'displayAccounts']);

Route::get("/historique", [ClientController::class, 'displayTransactions']);

Route::get("/profile", [ClientController::class, 'displayprofile']);

Route::post('/alimenter', [ClientController::class,'handleAlimenterForm']);

Route::post('/retrait', [ClientController::class,'handleRetraitForm']);


Route::post('/update-profile', [ClientController::class,'updateProfile']);
Route::post('/update-password', [ClientController::class,'updatePassword']);

Route::get('/logout', [ClientController::class, 'logout']);


Route::get("/dashboardAdmin", [AdminController::class, 'displayDashboardAdmin']);
Route::get("/clients", [AdminController::class, 'displayClientAdmin']);
Route::get("/compte", [AdminController::class, 'displayAccountsAdmin']);
Route::get("/transactions", [AdminController::class, 'displaytransactionsAdmin']);


$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);