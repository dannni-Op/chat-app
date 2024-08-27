<?php namespace App\Controllers;

use App\Views\View;
use App\Services\{UserService, ChatService, SessionService};

class ChatController {

    //private ChatService $chatService;
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct(){
	    //$this->chatService = new ChatService();
        $this->userService = new UserService();
        $this->sessionService = new SessionService();
    }

    public function index(){
        $session = $this->sessionService->current();
        
        $userId = (int) $session->userId;
        $user = $this->userService->findById($userId);

        $users = $this->userService->findMany();
        $users = array_filter($users, fn($value) => $value["id"] !== $userId);

        View::render("Chat/index", ["users" => $users, "user" => $user, "title" => "Chats"]);
    }

    public function chat($id){
        $user = $this->userService->findById((int) $id);
        if( !$user ){
            View::redirect("/chats");
        }

        View::render("Chat/chat", ["user" => $user]);
    }
}
