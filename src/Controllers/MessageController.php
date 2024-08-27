<?php namespace App\Controllers;

use App\Services\MessageService;
use App\Views\View;
use App\Models\MessageRequestModel;

class MessageController {

  private MessageService $messageService;

  public function __construct(){
    $this->messageService = new MessageService();
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
}
