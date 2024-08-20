<?php namespace App\Views;

class View {
    public static function render(string $view, array $params = []){
        require_once __DIR__ . "/Core/header.php";
        require_once __DIR__ . "/" . $view . ".php";
        require_once __DIR__ . "/Core/footer.php";
    }

    public static function redirect(string $url){
        header("Location: $url");
    }
}