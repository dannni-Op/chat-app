<?php namespace App\Controllers;

use App\Services\AuthService;
use App\Views\View;
use App\Models\{ SignupModel, SigninModel };
use \Throwable;

class AuthController {

    private AuthService $authServivce;

    public function __construct(){
        $this->authService = new AuthService();
    }
    
    public function signup(){
        View::render("Auth/signup", [
            "title" => "SignUp",
        ]);
    }

    public function signin(){
        View::render("Auth/signin", [
            "title" => "SignIn",
        ]);
    }

    public function api_signup(){
        $request = new SignupModel($_POST["firstname"], $_POST["lastname"], $_POST["username"], $_POST["password"], $_FILES["image"]["error"] === UPLOAD_ERR_NO_FILE ? null : $_FILES["image"]);
        try {
            $this->authService->signup($request);
            View::redirect("/auth/signin");
        } catch (Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function api_signin(){
        $request = new SigninModel();
        $request->username = $_POST["username"];
        $request->password = $_POST["password"];
        try {
            $this->authService->signin($request);
            View::redirect("/chats");
        } catch (Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function api_logout(){
    }
}