<?php namespace App\Repositories;

use \PDO;
use App\Database\Database;

class MessageRecipientRepository {
  private PDO $connection;

  public function __construct(){
    $this->connection = Database::getConnection();
  }

  public function save(int $recipientId, int $messageId){
    $stmt = $this->connection->prepare("insert into message_recipients (recipient_id, message_id) values (:recipientId, :messageId)");
    $stmt->bindParam(":recipientId", $recipientId);
    $stmt->bindParam(":messageId", $messageId);

    try {
      $stmt->execute();
      $id = $this->connection->lastInsertId();
      $messageRecipient = $this->findById($id);
      return $messageRecipient;
    } finally {
      $stmt->closeCursor();
    }
  }

  public function findById(int $id) {
    $stmt = $this->connection->prepare("select * from message_recipients where id = :id");
    $stmt->bindParam(":id", $id);

    try {
      $stmt->execute();
      $messageRecipient = $stmt->fetch();
      return $messageRecipient;
    } finally {
      $stmt->closeCursor();
    }
  }
}
