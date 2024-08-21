<?php namespace App\Controllers;

use App\Database\Database;
use App\Services\UserService;
use App\Views\View;

class UserController {
    
    private UserService $userService;
    
    public function __construct(){
        $this->userService = new UserService();
    }

    public function index(){
        View::render("Chat/index");
    }
}