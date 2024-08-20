<?php namespace App\Controllers;

use App\Database\Database;
use App\Services\UserService;

class UserController {
    
    private UserService $userService;
    
    public function __construct(){
        $this->userService = new UserService();
    }
}