<?php namespace App\Controllers;

use App\Views\View;

class ChatController {
    public function index(){
        View::render("Chat/index");
    }
}