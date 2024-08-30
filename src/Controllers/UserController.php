<?php namespace App\Controllers;

use App\Services\SessionService;
use App\Services\UserService;
use App\Views\View;

class UserController {

  private UserService $userService;
  private SessionService $sessionService;

  public function __construct(){
    $this->userService = new UserService();
    $this->sessionService = new SessionService();
  }

  public function index(){
    View::render("Chat/index");
  }

  public function api_search(){
    //displays a list of users without user login
    $session = $this->sessionService->current();
    $user = $this->userService->findById((int) $session->userId);

    $keywoard = $_GET["name"];
    $users = $this->userService->searchByName($keywoard);

    $users = array_filter($users, fn($u) => $u->firstname !== $user->firstname && $u->lastname !== $user->lastname );
    header("Content-Type: application/json");
    echo json_encode($users);
  }

  public function api_getAll(){
    //displays a list of users without user login
    $session = $this->sessionService->current();
    $user = $this->userService->findById((int) $session->userId);

    $users = $this->userService->findMany();

    $users = array_filter($users, fn($u) => $u->firstname !== $user->firstname && $u->lastname !== $user->lastname );
    header("Content-Type: application/json");
    echo json_encode($users);
  }
}
