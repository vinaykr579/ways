<?php
namespace App\ActionClasses\Login;

use Config;
use Validator;
use App\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\ActionClasses\Repo;
use App\Models\Common\PasswordReset;
use App\Notifications\PasswordResetSuccess;

class ResetPassword extends Repo{

    function action(){
        $actions = Config::get('actionlist.resetPassword.function');
        $this->runFuns($actions);
    }

    function doValidations(){
        if(!Session::get('TokenData')){
            $this->error['error'][] = Config::get('errors.something_wrong_happened');
            return;
        }
        $validator = Validator::make($this->request, 
            Config::get('validations.resetPassword'));
        if($validator->fails()){
            $this->error = $validator->errors();
        }
    }

    function setUpSessionData(){
        $sessionData = Session::get('TokenData');
        $this->request['EmailId'] = $sessionData['EmailId'];
        $this->request['Token'] = $sessionData['Token'];
    }

    function validateToken(){
        $this->props['passwordReset'] = PasswordReset::where([
            ['Token', $this->request['Token']],
            ['EmailId', $this->request['EmailId']]
            ])->first();
        if($this->props['passwordReset']){
            $dt = new \DateTime($this->props['passwordReset']->CreatedOnDate);
            $diff = $dt->diff(new \DateTime('now'));
            if(\formatDateInterval($diff, 'i') > 30){
                $this->props['passwordReset']->delete();
                $this->error = Config::get('errors.invalid_pwd_reset_token');
            }
        }else{
            $this->props['passwordReset']->delete();
            $this->error = Config::get('errors.invalid_pwd_reset_token');
        }    
    }

    function updateUserPasssword(){
        $user = Users::where('EmailId', $this->request['EmailId'])->
        first()->makeVisible('Password');
        $user->Password = Hash::make($this->request['password']);
        $user->save();
        $user->notify(new PasswordResetSuccess());
        $this->props['passwordReset']->delete();
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