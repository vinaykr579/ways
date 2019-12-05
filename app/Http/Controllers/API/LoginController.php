<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use App\Users;
use Validator;
use Config;

class LoginController extends Controller
{
    public $property = [], $error = NULL;
    function index(Request $request){
        
        $validator = Validator::make($request->all(), [
            'EmailId' => 'required|max:255',
            'Password' =>  'required|min:6'
        ]);
        
        if(!$validator->fails()){
            
            $this->property['requested_data'] = $request->all();
            $this->property['user'] = Users::where('EmailId', $request->get('EmailId'))->first();
            if($this->property['user']){
                $actions = ['comparePasswords', 'generateToken', 'createResponse'];
                foreach($actions as $action){
                    $this->$action();
                    if(!is_null($this->error)){
                        return response()->json(['status' =>200, 'message' =>$this->error]);
                    }
                }
                return response()->json([
                    'status' =>200,
                     'message' =>'success',
                      'response' =>$this->property['response']
                ]);            
            }else{
                return response()->json(['status' =>200, 'message' =>'Invalid email id.']);    
            }
             
        }else{
            return response()->json(['status' =>200, 'message' =>$validator->errors()]);
        }

    }

    private function getCustomClaimsForToken($user){
        return [
            'exp' => strtotime('+120 min', time()),
            'nbf' => time(),
            'iat' => time(),
            'sub' => $user->UserID
        ];
    }


    private function comparePasswords(){
        $userPwd = $this->property['requested_data']['Password'];
        $password = $this->property['user']->Password;
        if(!HASH::check($userPwd, $password)){
            $this->error = "Password not matched.";
        }
    }

    private function generateToken(){
        $customClaims = $this->getCustomClaimsForToken($this->property['user']);
        $this->property['token'] = JWTAuth::fromUser($this->property['user'], $customClaims);
        
    }

    private function createResponse(){
        $this->property['response']['token'] = $this->property['token'];
        $this->property['response']['user'] = $this->property['user'];
         
    }

}
