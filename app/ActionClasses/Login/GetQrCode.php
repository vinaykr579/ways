<?php
namespace App\ActionClasses\Login;

use Config;
use App\ActionClasses\Repo;
use App\Models\Common\UsersLoginHistory;

class GetQrCode extends Repo{

    function action(){
        $actions = Config::get('actionlist.getQrCode.function');
        $this->runFuns($actions);
    }

    function generateQrCode(){
        $imageName =  uniqid();
        $this->props['QRCode'] = md5($imageName);
        \QrCode::format('png')->size(230)
            ->merge('/resources/assets/images/logo_icon.png')
            ->errorCorrection('H')
            ->generate($this->props['QRCode'], public_path('images/qrcodes/'.$imageName.'.png'));
        $this->props['ImageUrl'] = url('/').'/images/qrcodes/'.$imageName.'.png';
    }

    function insertQrcodeToUsersLoginHistory(){
        $loginHistory = new UsersLoginHistory();
        $insertData = prepareData($loginHistory, Config::get('loginstruct.userLoginHistory'));
        $loginHistory->fill($insertData);
        $loginHistory->SessionId = $this->props['QRCode'];
        $loginHistory->save();
    }

    function createResponse(){
        return [
            'status' =>200,
             'message' =>'success',
              'response' => [
                  'qimage'=> $this->props['ImageUrl'],
                  'qrc' => $this->props['QRCode']
              ]
        ];
    }

}