<?php namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\{ SignupModel, SigninModel };
use App\Validations\AuthValidation;
use \Throwable;
use App\Exceptions\ValidationException;
use App\Database\Database;

class AuthService {

    private UserRepository $userRepository;
    
    public function __construct(){
        $this->userRepository = new UserRepository();
    }

    public function signup(SignupModel $request){
        AuthValidation::signup($request);

        try {
            Database::beginTransaction();

            if( $this->userRepository->findByUsername($request->username) ) throw new ValidationException("Username already exist.");

            if( $request->image ){
                $request->image["name"] = uniqid() . "." . pathinfo($request->image["name"], PATHINFO_EXTENSION);
            }
            
            $request->password = password_hash($request->password, PASSWORD_BCRYPT);
            $this->userRepository->save($request);
            if( $request->image ){
                $imageName = $request->image["name"];
                move_uploaded_file($request->image["tmp_name"], "images/$imageName");
            }

            Database::commitTransaction();
        } catch (Throwable $th) {
            Database::rollbackTransaction();
        }
    }

    public function signin(){

    }

    public function logout(){
        
    }
}