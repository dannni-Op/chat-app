<?php namespace App\Repositories;

use \PDO;
use App\Database\Database;
use App\Models\MessageModel;
use DateTime;

class MessageRepository {
  private PDO $connection;

  public function __construct(){
    $this->connection = Database::getConnection();
  }

  public function save(int $chatId, int $senderId, string $message): MessageModel {
    $stmt = $this->connection->prepare("insert into messages (chat_id, sender_id, message_text) values (:chatId, :senderId, :message)");
    $stmt->bindParam(":chatId", $chatId);
    $stmt->bindParam(":senderId", $senderId);
    $stmt->bindParam(":message", $message);

    try {
      $stmt->execute();
      $id = (int) $this->connection->lastInsertId();
      $message = $this->findById($id);
      return $message; 
    } finally {
      $stmt->closeCursor();
    }
  }

  public function findById(int $id): ?MessageModel {
    $stmt = $this->connection->prepare("select * from messages where id = :id");
    $stmt->bindParam(":id", $id);
    
    try {
      $stmt->execute();
      $message = $stmt->fetch(); 
      if( $message ) {
        $result = new MessageModel();
        $result->id = $message["id"];
        $result->chatId = $message["chat_id"];
        $result->senderId = $message["sender_id"];
        $result->messageText = $message["message_text"];
        $result->date = new DateTime($message["date"]);
        return $result; 
      }
      return null;
    } finally {
      $stmt->closeCursor();
    }
  }

  public function findByChatId(int $id): array {
    $stmt = $this->connection->prepare("select * from messages where chat_id = :id");
    $stmt->bindParam(":id", $id);
    
    try {
      $stmt->execute();
      $messages = $stmt->fetchAll(); 
      $result = [];
      foreach( $messages as $message ) {
        $temp = new MessageModel();
        $temp->id = $message["id"];
        $temp->chatId = $message["chat_id"];
        $temp->senderId = $message["sender_id"];
        $temp->messageText = $message["message_text"];
        $temp->date = new DateTime($message["date"]);
        $result[] = $temp;
      }

      return $result; 
    } finally {
      $stmt->closeCursor();
    }
  }
}
