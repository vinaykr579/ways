<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Common\PasswordReset;

class VerifyEmail extends Controller
{
    public function index(Request $request, $token){
        $tokenData =  PasswordReset::where([
            ['Token', $token],
            ['IsActive', '1'],
            ])->first();
        $validToken =false;
        if(!is_null($tokenData)){
            if(count($tokenData->toArray())){
                $validToken = true;
                \session(['TokenData' => $tokenData->toArray()]);
            }
        }
        return \view('verify-email',['validToken' => $validToken]);    
    }
}
