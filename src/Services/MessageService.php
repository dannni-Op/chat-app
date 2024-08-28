<?php namespace App\Services;

use App\Repositories\MessageRepository;
use App\Services\{ ChatService, MessageRecipientService };
use App\Database\Database;
use App\Models\MessageModel;
use App\Models\MessageRequestModel;
use \Throwable;

class MessageService {

  private MessageRepository $messageRepository;
  private ChatService $chatService;
  private MessageRecipientService $messageRecipientService;

  public function __construct(){
    $this->messageRepository = new MessageRepository();
    $this->chatService = new ChatService();
    $this->messageRecipientService = new MessageRecipientService();
  }

  public function create(MessageRequestModel $request): MessageModel {
    try {
      Database::beginTransaction();

      //validation the senderId and recipientId;

      $chat = $this->chatService->getBySenderIdAndRecipientId($request->senderId, $request->recipientId);
      if( !$chat ) {
        $chat = $this->chatService->create($request->chatName);
      }

      $message = $this->messageRepository->save($chat->id, $request->senderId, $request->messageText);
      $messageRecipient = $this->messageRecipientService->create($request->recipientId, $message->id);

      Database::commitTransaction();
      return $message;
    } catch (Throwable $tr) {
      Database::rollbackTransaction();
    }
  }

  public function getByChatId(int $id): array {
    try {
      Database::beginTransaction();
      $messages = $this->messageRepository->findByChatId($id);

      Database::commitTransaction();
      return $messages;
    } catch (Throwable $th) {
      Database::rollbackTransaction();
    }
  }
}
