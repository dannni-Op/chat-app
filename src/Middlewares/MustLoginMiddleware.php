<?php namespace App\Middlewares;

use App\Middlewares\Middleware;
use App\Services\SessionService;
use App\Views\View;

class MustLoginMiddleware implements Middleware {

    private SessionService $sessionsService;

    public function __construct(){
        $this->sessionService = new SessionService();
    }
    
    public function before(){
        $user = $this->sessionService->current();
        if( $user == null ) View::redirect("/auth/signin"); 
    }
}