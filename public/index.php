<?php 

require_once __DIR__ . "/../vendor/autoload.php";
use App\Router;
use App\Controllers\{ UserController, AuthController, ChatController, MessageController };
use App\Middlewares\{ MustNotLoginMiddleware, MustLoginMiddleware };

//auth
Router::get("/auth/signup", AuthController::class, "signup", [MustNotLoginMiddleware::class]);
Router::get("/auth/signin", AuthController::class, "signin", [MustNotLoginMiddleware::class]);
Router::get("/auth/logout", AuthController::class, "logout", [MustLoginMiddleware::class]);

Router::post("/api/auth/signup", AuthController::class, "api_signup");
Router::post("/api/auth/signin", AuthController::class, "api_signin");
Router::post("/api/auth/logout", AuthController::class, "api_logout");

//chats
Router::get("/chats", ChatController::class, "index", [MustLoginMiddleware::class]);
Router::get("/chats/([0-9a-zA-Z]*)", ChatController::class, "chat", [MustLoginMiddleware::class]);

Router::post("/api/messages", MessageController::class, "api_create", [MustLoginMiddleware::class]);

Router::dispatch();
