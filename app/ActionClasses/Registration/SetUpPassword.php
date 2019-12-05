<?php 
namespace App\ActionClasses\Registration;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\ActionClasses\Repo;
use Validator;
use Config;

class SetUpPassword extends Repo{

    function action(){
        $actions = ['doValidations', 'setUserPassword', 'setResponseMessage','flushSession'];
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
                    'message' => $this->props['message']
                ]
            ];
        }
        
    }

    function doValidations(){
        if(!Session::get('User') || Session::get('setpwd') != 1){
            $this->error['error'][] = Config::get('errors.something_wrong_happened');
            return;
        }
        $customMessages = [
            'required' => 'The :attribute field can not be blank.',
        ];
    
        $validator = Validator::make($this->request, [
            'password' => 'required|confirmed|min:6'
        ], $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
    }

    function setUserPassword(){
        $this->props['User'] = unserialize(session('User'));
        $this->props['User']->fill([
            'Password' => Hash::make($this->request['password'])
        ])->save();
    }

    function setResponseMessage(){
        if($this->props['User']->IsEmailVerified == 1){
            $this->props['message'] = Config::get('message.emailVerified');
        }else{
            $this->props['message'] = Config::get('message.emailNotVerified');
        }
    }

    function flushSession(){
        Session::flush();
    }
    
}
