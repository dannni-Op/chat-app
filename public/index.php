<?php 

require_once __DIR__ . "/../vendor/autoload.php";
use App\Router;
use App\Controllers\{ UserController, AuthController };


// Router::get("/", UserController::class, "index");

//auth
Router::get("/auth/signup", AuthController::class, "signup");
Router::get("/auth/logout", AuthController::class, "logout");
Router::get("/auth/signin", AuthController::class, "signin");

Router::dispatch();
