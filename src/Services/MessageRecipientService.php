<?php namespace App\Services;

use App\Repositories\MessageRecipientRepository;

class MessageRecipientService {

  private MessageRecipientRepository $messageRecipientRepository;

  public function __construct(){
    $this->messageRecipientRepository = new MessageRecipientRepository();
  }

  public function create(int $recipientId, int $messageId){
    $messageRecipient = $this->messageRecipientRepository->save($recipientId, $messageId);
    return $messageRecipient;
  }
}
