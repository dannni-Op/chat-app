<?php namespace App\Repositories;

use \PDO;
use App\Database\Database;

class UserRepository {

    private PDO $connection; 
    
    public function __construct(){
        $this->connection = Database::getConnection(); 
    }
}