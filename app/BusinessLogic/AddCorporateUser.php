<?php 
namespace App\BusinessLogic;

use Config;
use App\BusinessLogic\CommonBusinessLogic;
use App\Users;
use App\Models\Common\Corporates;
use Illuminate\Support\Facades\DB;

class AddCorporateUser extends CommonBusinessLogic{

    public function action(){
        $actions = ['createUserIfNotExist', 'createCorporateIfNotExist'];
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


    public function createCorporateIfNotExist(){
        $corporateuserExist = DB::table(Config::get('tables.corporates'))
        ->whereRaw(" `UserId`='{$this->mainObject->request['User']->UserID}' ".
         " AND  `CorporateUserId`= '{$this->mainObject->actionList['UserId']}'  ")->get();
        if(!count(current($corporateuserExist))){
            $corporateObj = new Corporates();
            $this->mainObject->actionList['adminUser'] = $this->mainObject->request['User'];
            $this->mainObject->actionList['UserRole'] = $this->mainObject->request['UserRole'];
            $this->mainObject->actionList['MaximumBookingAmount'] = $this->mainObject->request['MaximumBookingAmount'];
            $corporateObj->props = $this->mainObject->actionList;
            $insertData = \prepareData($corporateObj, Config::get('corporatestruct.corporates'), $this->mainObject->actionList);
            $corporateObj->fill($insertData);
            $corporateObj->save(); 
        }else{
            $corporateUser = current($corporateuserExist)[0];
            if($corporateUser->IsActive == 1){
                $this->error = Config::get('errors.already_created_user');
            }else{
                $corporateUser = Corporates::whereRaw(" `CorporateId`='{$corporateUser->CorporateId}'")->first();
                $corporateUser->IsActive = '1';
                $corporateUser->IsVerified = '1';
                $corporateUser->save();
            }
        } 
    }
}