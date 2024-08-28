<?php namespace App\Models;

use \DateTime;

class MessageModel {
  public int $id; 
  public int $chatId;
  public int $senderId;
  public string $messageText;
  public DateTime $date;
}
