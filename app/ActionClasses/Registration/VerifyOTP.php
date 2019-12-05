<?php 
namespace App\ActionClasses\Registration;

use App\ActionClasses\Repo;
use App\Models\Common\OTP;
use App\Models\Common\Corporates;
use Validator;

class VerifyOTP extends Repo{

    function action(){
        $actions = ['doValidations', 'verifyUserOTP', 'verifyCorporate'];
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

    function doValidations(){
        if(!session('OTPId')){
            $this->error['error'][] = Config::get('errors.something_wrong_happened');
            return;
        }
        $customMessages = [
            'required' => 'The :attribute field can not be blank.',
        ];
    
        $validator = Validator::make($this->request, [
            'OTPCode' => 'required|numeric',
        ], $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
    }

    function verifyUserOTP(){
        $this->props['User'] = unserialize(session('User'));
        $otp = OTP::where([
            ['OTPId', session('OTPId')],
            ['UserId', $this->props['User']->UserID],
            ['OTPCode', $this->request['OTPCode']],
            ['IsConsumed', 0],
        ])->whereRaw(" TIMESTAMPDIFF(MINUTE, `GeneratedON`, `EXpiredOn`) <= 30 ")
        ->first();
        if(!count($otp)){
            $this->error = Config::get('errors.invalid_otp');
        }else{
            $otp->IsConsumed = 1;
            $otp->save();
            $this->props['User']->VerifiedDate = Date('Y-m-d H:i:s');
            $this->props['User']->IsActive = 1;
            $this->props['User']->RegistrationStatus = 1;
            $this->props['User']->save();
            session(['setpwd' => 1]);
            session(['User' => serialize($this->props['User'])]);
        }
    }

    function verifyCorporate(){
        $corporate  = Corporates::whereRaw(" `UserId`= '{$this->props['User']->UserID}' ". 
         " AND `IsVerified` = '0' ")->first();
        $corporate->IsVerified = '1';
        $corporate->VerifiedDate = date('Y-m-d H:i:s');
        $corporate->save(); 
    }
    
}
