<?php namespace App\Controllers;

use App\Services\AuthService;
use App\Views\View;

class AuthController {

    private AuthService $authServivce;

    public function __construct(){
        $this->authService = new AuthService();
    }
    
    public function signup(){
        View::render("Auth/signup", [
            "title" => "SignUp",
        ]);
    }

    public function signin(){
        View::render("Auth/signin", [
            "title" => "SignIn",
        ]);
    }

    public function api_signup(){

    }

    public function api_signin(){
    }

    public function api_logout(){
    }
}