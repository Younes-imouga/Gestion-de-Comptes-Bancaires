<?php 
    include '../core/route.php';
    include '../core/router.php';
    include '../config/db.php';
    include '../controllers/AdminController.php';
    include '../controllers/ClientController.php';
    include '../controllers/AuthController.php';

    $router = new Router();
    Route::setRouter($router);

    Route::get();
    Route::post();
