<?php namespace App\Services;

use App\Repositories\MessageRepository;
use App\Services\{ ChatService, MessageRecipientService };
use App\Database\Database;
use App\Models\MessageRequestModel;

class MessageService {

  private MessageRepository $messageRepository;
  private ChatService $chatService;
  private MessageRecipientService $messageRecipientService;

  public function __construct(){
    $this->messageRepository = new MessageRepository();
    $this->chatService = new ChatService();
    $this->messageRecipientService = new MessageRecipientService();
  }

  public function create(MessageRequestModel $request){
    try {
      Database::beginTransaction();

      //validation the senderId and recipientId;

      $chat = $this->chatService->create($request->senderId, $request->recipientId, $request->chatName);
      $message = $this->messageRepository->save($chat["id"], $request->senderId, $request->messageText);
      $messageRecipient = $this->messageRecipientService->create($request->recipientId, $message["id"]);

      Database::commitTransaction();
    } catch (Throwable $tr) {
      Database::rollbackTransaction();
    }
  }
}
