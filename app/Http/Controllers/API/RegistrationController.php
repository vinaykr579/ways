<?php
namespace App\Http\Controllers\API;

use Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActionClasses\Registration\DoRegistration;
use App\ActionClasses\Registration\VerifyOTP;
use App\ActionClasses\Registration\SetUpPassword;
use App\ActionClasses\Registration\VerifyEmail;

class RegistrationController extends Controller
{
    function index(Request $request){
         $obj = new DoRegistration($request->all());
         $obj->action();
         return response()->json($obj->getResponse());    
    }


    function verifyOTP(Request $request){
        $obj = new VerifyOTP($request->all());
        $obj->action();
        return response()->json($obj->getResponse());    
    }

    function setPassword(Request $request){
        $obj = new SetUpPassword($request->all());
        $obj->action();
        return response()->json($obj->getResponse());  
    }
    
    function verifyEmail(Request $request, $token){
        $obj = new VerifyEmail($request->all());
        $obj->request['Token'] = $token;
        $obj->action();
        $msg = '';
        if(!empty($obj->error)){
            $msg = $obj->error;
        }else{
            $msg = sprintf(Config::get('message.emailVerificationSuccess'), url('/').'/login');
        }
        return view('emailverification', ['message'=> $msg]);
    }
}
