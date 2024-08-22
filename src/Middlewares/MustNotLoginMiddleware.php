<?php namespace App\Middlewares;

use App\Middlewares\Middleware;
use App\Services\SessionService;
use App\Views\View;

class MustNotLoginMiddleware implements Middleware {

    private SessionService $sessionService;

    public function __construct(){
        $this->sessionService = new SessionService();
    }
    
    public function before(){
        $user = $this->sessionService->current();
        if( $user ) View::redirect("/chats");
    }
} 