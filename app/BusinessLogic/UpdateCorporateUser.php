<?php 
namespace App\BusinessLogic;

use Config;
use App\BusinessLogic\CommonBusinessLogic;
use App\Users;
use App\Models\Common\Corporates;
use Illuminate\Support\Facades\DB;

class UpdateCorporateUser extends CommonBusinessLogic{

    public function action(){
        $actions = ['createUserIfNotExist', 'updateCorporateUser'];
        $this->runFunc($actions);
    }

    public function createUserIfNotExist(){
        if($this->mainObject->actionList['createUser'] == 1){
            $userObj = new Users();
            $insertData = prepareData($userObj, Config::get('corporatestruct.users'), $this->mainObject->request); 
            $userObj->fill($this->mainObject->request);
            $userObj->save();
            $this->mainObject->actionList['UserId'] = $userObj->UserID;
        }
    }


    public function updateCorporateUser(){
        $corporateuserExist = DB::table(Config::get('tables.corporates'))
        ->whereRaw(" `UserId`='{$this->mainObject->request['User']->UserID}' ".
         " AND  `CorporateUserId`= '{$this->mainObject->actionList['UserId']}'  ")->get();
        if(!count(current($corporateuserExist))){
            $corporateObj = Corporates::find($this->mainObject->request['CorporateId']);
            $corporateObj->UserId = $this->mainObject->request['User']->UserID;
            $corporateObj->CorporateUserId = $this->mainObject->actionList['UserId'];
            $corporateObj->UserRole = $this->mainObject->request['UserRole'];
            $corporateObj->MaximumBookingAmount = $this->mainObject->request['MaximumBookingAmount'];
            $corporateObj->IsActive = '1';
            $corporateObj->IsVerified = '1';
            $corporateObj->save(); 
        }else{
            $corporateUser = Corporates::whereRaw(" `CorporateId`='{$this->mainObject->request['CorporateId']}'")->first();
            $corporateUser->CorporateUserId = $this->mainObject->actionList['UserId'];
            $corporateUser->UserId = $this->mainObject->request['User']->UserID;
            $corporateUser->IsActive = '1';
            $corporateUser->IsVerified = '1';
            $corporateUser->UserRole = $this->mainObject->request['UserRole'];
            $corporateUser->MaximumBookingAmount = $this->mainObject->request['MaximumBookingAmount'];
            $corporateUser->save();
        
        } 
    }
}