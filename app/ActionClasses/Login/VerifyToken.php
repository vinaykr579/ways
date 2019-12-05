<?php 
namespace App\ActionClasses\Login;

use Validator;
use App\ActionClasses\Repo;
use App\Models\Common\PasswordReset;

class VerifyToken extends Repo{

    function action(){
        $actions = Config::get('actionlist.verifyToken.function');
        $this->runFuns($actions);
    }

    function doValidations(){
        $validator = Validator::make($this->request, 
            Config::get('validations.verifyToken'));
        if($validator->fails()){
            $this->error = $validator->errors();
        }
    }

    function validateTokenForResetPassword(){
        $passwordReset = PasswordReset::where('Token', $this->request['Token'])->first();
        if($passwordReset){
            $dt = new DateTime($passwordReset->CreatedOnDate);
            $dt->diff(new DateTime('now'));
            if($dt->i > 30){
                $passwordReset->delete();
                $this->error = Config::get('errors.invalid_pwd_reset_token');
            }
        }else{
            $this->error = Config::get('errors.invalid_pwd_reset_token');
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
                'message' => 'success'
            ];
        }
    }
}