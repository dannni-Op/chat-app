<?php namespace App\Repositories;

use App\Database\Database;
use App\Models\ChatModel;
use \PDO;

class ChatRepository {
  private PDO $connection;

  public function __construct(){
    $this->connection = Database::getConnection();
  }

  public function save(string | null $name = null): ChatModel {
    $stmt = $this->connection->prepare("insert into chats (name) values (:name)");
    $stmt->bindParam(":name", $name);
    $stmt->execute();

    try {
      $id = $this->connection->lastInsertId();
      $chat = $this->findById($id);
      return $chat;
    } finally {
      $stmt->closeCursor();
    }
  }

  public function findBySenderIdAndRecipientId(int $senderId, int $recipientId): ?ChatModel {
    $stmt = $this->connection->prepare(" select chats.id, chats.name from chats join messages on (chats.id = messages.chat_id) join message_recipients on (messages.id = message_recipients.message_id) where (messages.sender_id = :senderId or message_recipients.recipient_id = :senderId) and (message_recipients.recipient_id = :recipientId or messages.sender_id = :recipientId)");
    $stmt->bindParam(":senderId", $senderId);
    $stmt->bindParam(":recipientId", $recipientId);
    $stmt->execute();

    try {
      $chat = $stmt->fetch();
      if( $chat ){
        $result = new ChatModel();
        $result->id = $chat["id"];
        if( $chat["name"] ) {
          $result->name = $chat["name"];
        }
        return $result;
      }

      return null;
    } finally {
      $stmt->closeCursor();
    }
  }

  public function findById(int $id): ?ChatModel {
    $stmt = $this->connection->prepare("select * from chats where id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    try {
      $chat = $stmt->fetch();
      if( $chat ){
        $result = new ChatModel();
        $result->id = $chat["id"];
        if( $chat["name"] ) {
          $result->name = $chat["name"];
        }
        return $result;
      }
      return null;
    } finally {
      $stmt->closeCursor();
    }
  }
}
