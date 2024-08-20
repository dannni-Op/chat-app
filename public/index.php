<?php 

require_once __DIR__ . "/../vendor/autoload.php";
use App\Router;
use App\Controllers\{ UserController, AuthController };

//auth
Router::get("/auth/signup", AuthController::class, "signup");
Router::get("/auth/signin", AuthController::class, "signin");
Router::get("/auth/logout", AuthController::class, "logout");

Router::post("/api/auth/signup", AuthController::class, "api_signup");
Router::post("/api/auth/signin", AuthController::class, "api_signin");

Router::dispatch();
