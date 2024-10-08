<?php namespace App\Controllers;

use App\Views\View;
use App\Services\{UserService, ChatService, SessionService, MessageService};

class ChatController {

  private ChatService $chatService;
  private UserService $userService;
  private SessionService $sessionService;
  private MessageService $messageService;

  public function __construct(){
    $this->chatService = new ChatService();
    $this->userService = new UserService();
    $this->sessionService = new SessionService();
    $this->messageService = new MessageService();
  }

  public function index(){
    $session = $this->sessionService->current();

    $userId = (int) $session->userId;
    $user = $this->userService->findById($userId);

    $keyword = '';
    $users = $this->userService->findMany();
    if( isset($_GET["name"]) ) {
      $keyword = $_GET["name"];
      if( !$keyword ) {
        View::redirect("/chats");
      }
      $users = $this->userService->searchByName($keyword);
    } 

    $users = array_filter($users, fn($user) => $user->id !== $userId);
    View::render("Chat/index", ["users" => $users, "user" => $user, "title" => "Chats", "keyword" => $keyword]);
  }

  public function chat($id){
    $session = $this->sessionService->current();

    $userId = (int) $session->userId;
    $user = $this->userService->findById($userId);

    $recipient = $this->userService->findById((int) $id);
    if( !$recipient ){
      View::redirect("/chats");
    }

    $chat = $this->chatService->getBySenderIdAndRecipientId($userId, $id);

    $messages = $this->messageService->getByChatId($chat->id);
    View::render("Chat/chat", ["user" => $user, "recipient" => $recipient, "messages" => $messages]);
  }
}
