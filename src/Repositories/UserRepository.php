<?php namespace App\Repositories;

use \PDO;
use App\Database\Database;
use App\Models\{UserModel, SignupModel, SigninModel};

class UserRepository {

    private PDO $connection; 
    
    public function __construct(){
        $this->connection = Database::getConnection(); 
    }

    public function save(SignupModel $request): bool {
        $stmt = $this->connection->prepare("insert into users (firstname, lastname, username, password, image, status) values (:firstname, :lastname, :username, :password, :image, :status)");
        $stmt->bindParam(":firstname", $request->firstname);
        $stmt->bindParam(":lastname", $request->lastname);
        $stmt->bindParam(":username", $request->username);
        $stmt->bindParam(":password", $request->password);
        $stmt->bindParam(":image", $request->image["name"]);
        $stmt->bindParam(":status", $request->status);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }

    public function findById(int $id): ?UserModel {
        $stmt = $this->connection->prepare("select * from users where id = :id ");
        $stmt->bindParam(':id', intval($id));
        $stmt->execute();

        try {
            $row = $stmt->fetch();

            if( !$row ) return null;
            
            $user = new UserModel();
            $user->firstname = $row["firstname"];
            $user->lastname = $row["lastname"];
            $user->username = $row["username"];
            $user->status = $row["status"];
            if( $row["image"] ){
                $user->image = $row["image"];
            }

            return $user;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function findByUsername(string $username): ?UserModel {
        $stmt = $this->connection->prepare("select * from users where username = :username ");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        try {
            $row = $stmt->fetch();

            if( !$row ) return null;
            
            $user = new UserModel();
            $user->id = $row["id"];
            $user->firstname = $row["firstname"];
            $user->lastname = $row["lastname"];
            $user->username = $row["username"];
            $user->password = $row["password"];
            $user->status = $row["status"];
            if( $row["image"] ){
                $user->image = $row["image"];
            }

            return $user;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function findMany(): array {
        $stmt = $this->connection->prepare("select * from users");
        $stmt->execute();

        try {
            $users = $stmt->fetchAll();
            return $users;
        } finally {
            $stmt->closeCursor();
        }
    }

    public function update(int $id, array $request){
        $columns = [];
        try {
            foreach($request as $key => $value){
                $columns[] = "$key = :$key";
            }

            $clause = implode(', ', $columns);

            $stmt = $this->connection->prepare("update users set $clause where id = :id");
            $stmt->bindParam(":id", $id);
            foreach($request as $key => $value){
                $stmt->bindParam(":$key", $value);
            }
            
            $stmt->execute();
        } finally {
            $stmt->closeCursor();
        }
    }
}