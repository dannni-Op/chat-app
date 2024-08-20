<?php namespace App\Validations;

use App\Models\{ SignupModel, SigninModel };
use App\Exceptions\ValidationException;

class AuthValidation {
    public static function signup(SignupModel $request){
        if(!$request->firstname || !$request->lastname || !$request->username || !$request->password){
            throw new ValidationException("firstname or lastname or username or password fields cannot be empty.");
        }

        if( $request->image ){
            $maxFileSize = 2 * 1024 * 1024;
            $extensions = ["jpg", "jpeg", "png"];

            $imageSize = $request->image["size"];
            $imageExtension = pathinfo($request->image["name"], PATHINFO_EXTENSION);

            if( ($imageSize > $maxFileSize) || $imageSize === 0) throw new ValidationException("Invalid file size.");
            if( !in_array($imageExtension, $extensions) ) throw new ValidationException("Invalid file type."); 
        }

        if( strlen($request->password) < 8) throw new ValidationException("Password must be at least 8 characters long.");
    }
}