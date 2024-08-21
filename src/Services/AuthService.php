<?php namespace App\Services;

use App\Repositories\UserRepository;
use App\Models\{ SignupModel, SigninModel };
use App\Validations\AuthValidation;
use \Throwable;
use App\Exceptions\ValidationException;
use App\Database\Database;
use App\Services\SessionService;

class AuthService {

    private UserRepository $userRepository;
    private SessionService $sessionService;
    
    public function __construct(){
        $this->userRepository = new UserRepository();
        $this->sessionService = new SessionService();
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

    public function signin(SigninModel $request){
        AuthValidation::signin($request);

        $user = $this->userRepository->findByUsername($request->username);
        if( !$user ) throw new ValidationException("Username or password is wrong.");

        if( !password_verify($request->password, $user->password) ) throw new ValidationException("Username or password is wrong.");

        $this->sessionService->create($user->id);
    }

    public function logout(){
        
    }
}