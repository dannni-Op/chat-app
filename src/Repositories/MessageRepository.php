<?php namespace App\Repositories;

use \PDO;
use App\Database\Database;

class MessageRepository {
  private PDO $connection;

  public function __construct(){
    $this->connection = Database::getConnection();
  }

  public function save(int $chatId, int $senderId, string $message){
    $stmt = $this->connection->prepare("insert into messages (chat_id, sender_id, message_text) values (:chatId, :senderId, :message)");
    $stmt->bindParam(":chatId", $chatId);
    $stmt->bindParam(":senderId", $senderId);
    $stmt->bindParam(":message", $message);

    try {
      $stmt->execute();
      $id = $this->connection->lastInsertId();
      $message = $this->findById($id);
      return $message; 
    } finally {
      $stmt->closeCursor();
    }
  }

  public function findById(int $id){
    $stmt = $this->connection->prepare("select * from messages where id = :id");
    $stmt->bindParam(":id", $id);
    
    try {
      $stmt->execute();
      $message = $stmt->fetch(); 
      return $message; 
    } finally {
      $stmt->closeCursor();
    }
  }
}
