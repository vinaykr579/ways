<?php
namespace App\ActionClasses\Login;

use Config;
use Validator;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Common\UsersLoginHistory;
use App\ActionClasses\Repo;
use App\Users;

class QrCodeStatus extends Repo{

    function action(){
        $actions = Config::get('actionlist.qrCodeStatus.function');
        $this->runFuns($actions);
    }

    function doValidations(){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.',
            'string' => 'The :attribute key must be a string.'
        ];
    
        $validator = Validator::make($this->request, 
            Config::get('validations.qrCodeStatus'), 
            $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
    }

    function getLoginRequestStatus(){
        $where = " `SessionId` = '{$this->request['QrC']}' 
        AND LoginInTime IS NOT NULL AND UserId IS NOT NULL ";
        $qrcStatus = DB::table(Config::get('tables.users_login_history'))
        ->whereRaw($where)->first();
        if(!is_null($qrcStatus) && isset($qrcStatus->LoginId) && !empty($qrcStatus->LoginId)){
            $loginHistoryObj = new UsersLoginHistory();
            $data = [];
            $data['PlatformInfo'] = $loginHistoryObj->getPlatformInfo();
            $data['IPAddress'] = $loginHistoryObj->getIpAddress();
            UsersLoginHistory::whereRaw(" `SessionId`='{$this->request['QrC']}'")->update($data);
            $this->props['status'] = true;
            $this->props['user'] = Users::where('UserID', $qrcStatus->UserId)->first();
            $this->generateToken();
        }else{
            $this->props['statue'] = false;
        }
    }

    private function getCustomClaimsForToken(){
        return [
            'exp' => strtotime('+120 min', time()),
            'nbf' => time(),
            'iat' => time(),
            'sub' => $this->props['user']->UserID
        ];
    }

    private function generateToken(){
        $customClaims = $this->getCustomClaimsForToken();
        $this->props['token'] = JWTAuth::fromUser($this->props['user'], $customClaims);
        
    }

    function createResponse(){
        return [
            'status' => 200,
            'message' => 'success',
            'response' => $this->props
        ];
    }
}