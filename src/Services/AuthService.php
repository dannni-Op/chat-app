<?php namespace App\Services;

use App\Repositories\UserRepository;

class AuthService {

    private UserRepository $userRepository;
    
    public function __construct(){
        $this->userRepository = new UserRepository();
    }

    public function signup(){

    }

    public function signin(){

    }

    public function logout(){
        
    }
}