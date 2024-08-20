<?php namespace App\Models;

class SigninModel {
    public function __construct(
        public string $firstname,
        public string $password,
    ){}
}