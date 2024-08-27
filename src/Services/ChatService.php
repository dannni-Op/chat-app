<?php namespace App\Services;

use App\Repositories\ChatRepository;

class ChatService {
   private ChatRepository $chatRepository; 

  public function __construct(){
    $this->chatRepository = new ChatRepository();
  }

  public function create(int $senderId, int $recipientId, string | null $name = null){
    $chat = $this->chatRepository->findBySenderIdAndRecipientId($senderId, $recipientId);    
    if( !$chat ) {
      $chat = $this->chatRepository->save($name);
    }
    return $chat;
  }
}
