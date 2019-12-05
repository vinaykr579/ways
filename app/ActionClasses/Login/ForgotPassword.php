<?php 
namespace App\ActionClasses\Login;

use Config;
use Validator;
use App\Users;
use App\Models\Common\PasswordReset;
use App\Notifications\PasswordResetRequest;
use App\ActionClasses\Repo;

class ForgotPassword extends Repo{

    function action(){
        $actions  = Config::get('actionlist.forgotPassword.function');
        $this->runFuns($actions); 
    }

    function doValidations(){
        $validator = Validator::make($this->request, 
            Config::get('validations.forgotPassword'));
        if($validator->fails()){
            $this->error = $validator->errors();
            return;
        }
        $this->props['user'] = Users::where('EmailId', $this->request['EmailId'])->first();
        if (!$this->props['user']){
            $this->error = 'We cant find a user with that e-mail address.';
        }
    }

    function createResetPasswordToken(){
        $passwordReset = PasswordReset::updateOrCreate(
            ['EmailId' => $this->props['user']->EmailId],
            [
                'UserId' => $this->props['user']->UserID,
                'EmailId' => $this->props['user']->EmailId,
                'Token' => str_random(60)
            ]
        );
        if($this->props['user'] && $passwordReset){
            $this->props['user']->notify(
                new PasswordResetRequest($passwordReset->Token)
            );
        }
            
    }

    function createResponse(){
        if($this->error){
            return [
                'status'=> '200',
                'message' => $this->error
            ];
        }else{
            return [
                'status'=> '200',
                'message' => 'We have e-mailed your password reset link!'
            ];
        }
    }
}

