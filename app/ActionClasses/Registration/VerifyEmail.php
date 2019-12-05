<?php 
namespace App\ActionClasses\Registration;

use Illuminate\Support\Facades\DB;
use App\ActionClasses\Repo;
use App\Models\Common\EmailVerifications;
use App\Users;
use Config;

class VerifyEmail extends Repo{

    function action(){
        $actions = [ 'verifyToken', 'verifyUserEmail'];
        $this->runFuns($actions);
    }

    function createResponse(){
        if(!is_null($this->error)){
            return [
                'status' => 200,
                'message' => 'error',
                'response' => [
                    'error' => $this->error
                ]
            ];
        }else{
            return [
                'status' => 200,
                'message' => 'success',
                'response' => [
                ]
            ];
        }
        
    }

    function verifyToken(){
        $emailVerifications = EmailVerifications::where([
            ['VerificationCode', '=', $this->request['Token']],
            ['Status', '0'],
        ])->first();
        if(!count($emailVerifications)){
            $this->error = Config::get('errors.something_wrong_happened');
        }else{
            $emailVerifications->Status = '1';
            $emailVerifications->save();
            $this->props['UserId'] = $emailVerifications->UserId; 
        }
    }

    function verifyUserEmail(){
        $user = Users::where([
            ['UserID' , $this->props['UserId']],
            ['IsEmailVerified' , '0'],
            ])->first();
        if(count($user)){
            $user->IsEmailVerified = '1';
            $user->EmailVerifiedDate = date('Y-m-d H:i:s');
            $user->save();
        }else{
            $this->error = Config::get('errors.something_wrong_happened');
        }    
    }

    
}
