<?php 
namespace App\ActionClasses\Registration;

use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmail;
use App\Notifications\SendOTP;
use App\ActionClasses\Repo;
use App\Users;
use App\Models\Common\Corporates;
use Validator;

class DoRegistration extends Repo{

    function action(){
        $actions = ['doValidations', 'saveUser', 'createCorporateUser'];
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
                    'message' => 'We have sent an OTP and mail to verify.'
                ]
            ];
        }
        
    }

    function doValidations(){
        $customMessages = [
            'required' => 'The :attribute field can not be blank.',
            'unique' => 'The :attribute field is already registered.'
        ];
    
        $validator = Validator::make($this->request, [
            'EmailId' => 'required|max:255',
            'MobileNumber' => 'required|max:10|min:10',
            'AlternateNumber' => 'max:10|min:10'
        ], $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
    }

    function checkUserIfExist(){
        $users = Users::whereRaw(" `EmailId` = '{$this->request['EmailId']}' OR `MobileNumber`='{$this->request['MobileNumber']}'")->get();
        if(count($users) > 1){
            $this->error = ['error'=>'Mobilenumber and EmailId are already registered.'];
        }elseif(count($users)){
            $user = current($users);
            if($user->RegistrationStatus == '0'){
                $user->notify(new SendOTP($this));
                $this->error = ['verifyMobile' => 'Please verify your mobile no'];
                session(['OTPId' => $this->props['OTPId']]);
                session(['User' => serialize($user)]);
                return;
            }

            if(empty($user->Password)){
                $this->error = ['setPassword' => 'Please set your password.'];
                session(['User' => serialize($user)]);
                return;
            }

            if($user->IsEmailVerified === '0'){
                $token = hash('tiger192,3',uniqid());
                $user->notify(new VerifyEmail($token));
                $this->error = ['verifyEmail'=>'Please verify your email id.'];
            }
        }
    }

    function saveUser(){
        $user = new Users();
        $user->fill($this->request);
        $user->IsCorporate = 1;
        $user->save();
        $this->sendVerificationLink($user);
        $this->createCorporateUser($user);
    }

    function createCorporateUser($user){
        $corporate = new Corporates();
        $corporate->UserId = $user->UserID;
        $corporate->UserRole = '1';
        $corporate->save();
    }

    function sendVerificationLink(Users $user){
        $token = hash('tiger192,3',uniqid());
        $user->notify(new SendOTP($this));
        $user->notify(new VerifyEmail($token));
        session(['OTPId' => $this->props['OTPId']]);
        session(['User' => serialize($user)]);
    }
    
}
