<?php namespace App\Repositories;

use \PDO;
use App\Database\Database;
use App\Models\SessionModel;

class SessionRepository {
    private PDO $connection;

    public function __construct(){
        $this->connection = Database::getConnection();
    }

    public function save(SessionModel $session){
        $stmt = $this->connection->prepare("insert into sessions (id, user_id) values (:id, :user_id)");
        $stmt->bindParam(":id", $session->id);
        $stmt->bindParam(":user_id", $session->userId);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function findById(string $id): ?SessionModel {
        $stmt = $this->connection->prepare("select * from sessions where id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $session = $stmt->fetch();
        if( !$session ) return null;
        $result = new SessionModel();
        $result->id = $session["id"];
        $result->userId = $session["user_id"];
        return $result;
    }

    public function delete(string $id){
        $stmt = $this->connection->prepare("delete from sessions where id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->closeCursor();
    }
}