<?php namespace App\Models;

class MessageRequestModel {
  public int $senderId;
  public int $recipientId;
  public string $messageText;
  public ?string $chatName = null;
}
