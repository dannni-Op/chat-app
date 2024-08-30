<?php namespace App\Models;

class UserModel {
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $username;
    public string $password;
    public ?string $image;
    public string $status;
}
