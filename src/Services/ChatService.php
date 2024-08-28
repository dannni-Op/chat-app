<?php namespace App\Services;

use App\Models\ChatModel;
use App\Repositories\ChatRepository;

class ChatService {
   private ChatRepository $chatRepository; 

  public function __construct(){
    $this->chatRepository = new ChatRepository();
  }

  public function create(string | null $name = null): ChatModel {
    $chat = $this->chatRepository->save($name);
    return $chat;
  }

  public function getBySenderIdAndRecipientId(int $senderId, int $recipientId): ?ChatModel {
    $chat = $this->chatRepository->findBySenderIdAndRecipientId($senderId, $recipientId);    
    return $chat;
  }
}
