<?php 
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifications\PasswordResetSuccess;
use App\ActionClasses\Login\ForgotPassword;
use App\ActionClasses\Login\ResetPassword;
use App\ActionClasses\Login\VerifyToken;



class PasswordResetController extends Controller{

    function create(Request $request){
        $obj = new ForgotPassword($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    function sendEmail(){
        $to_name = 'Vinay';
        $to_email = 'vinay@waysapp.in';
        $data = array('name'=>"Vinay", "body" => "Test mail");
            
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                    ->subject('Artisans Web Testing Mail');
            $message->from('support@waysapp.in','Artisans Web');
        });
    }

    function verifyToken(Request $request){
        $obj = new VerifyToken($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    function reset(Request $request){
        $obj = new ResetPassword($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }
}