<?php 

require_once __DIR__ . "/../vendor/autoload.php";
use App\Router;
use App\Controllers\{ UserController };


Router::get("/", UserController::class, "index");

Router::dispatch();
