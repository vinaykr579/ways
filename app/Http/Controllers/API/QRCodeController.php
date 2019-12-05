<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActionClasses\Login\GetQrCode;
use App\ActionClasses\Login\QrCodeStatus;

class QRCodeController extends Controller
{
    function login(Request $request){
        $repoObj = new Registration();
        $repoObj->action($request->all());
        return response()->json($repoObj->getResponse());    
    }

    function getQrCode(Request $request){
        $obj = new GetQrCode($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    function qrCStatus(Request $request){
        $obj = new QrCodeStatus($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

}
