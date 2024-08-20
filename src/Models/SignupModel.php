<?php namespace App\Models;

class SignupModel {
    public function __construct(
        public string $firstname,
        public string $lastname,
        public string $username,
        public string $password,
        public ?array $image,
        public string $status = "offline",
    ){}
}