<?php namespace App\Controllers;

use App\Services\{MessageService, ChatService};
use App\Views\View;
use App\Models\MessageRequestModel;
use \Throwable;

class MessageController {

  private MessageService $messageService;
  private ChatService $chatService;

  public function __construct(){
    $this->messageService = new MessageService();
    $this->chatService = new ChatService();
  }

  public function api_create(){
    try {

      $request = new MessageRequestModel();
      $request->senderId = $_POST["senderId"];
      $request->recipientId = $_POST["recipientId"];
      $request->messageText = $_POST["message"];

      $message = $this->messageService->create($request);
      $recipientId = $_POST["recipientId"];
      View::redirect("/chats/$recipientId");
    } catch (Throwable $th) {
      echo $th;
    }
  }

  public function api_get(){
    $senderId = $_GET["senderId"];
    $recipientId = $_GET["recipientId"];
    if( $senderId && $recipientId ) {
      $chat = $this->chatService->getBySenderIdAndRecipientId($senderId, $recipientId);
      $messages = $this->messageService->getByChatId($chat->id);

      header("Content-Type: application/json");
      echo json_encode($messages);
    }
  }
}
