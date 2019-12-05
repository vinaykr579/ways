<?php
namespace App\Validations;

use Config;
use Validator;
use App\Validations\CommonValidations;
use Illuminate\Support\Facades\DB;

class UpdateCorporateUserValidation extends CommonValidations{
    
    public function action(){
        $actions = ['doValidations', 'verifyCorporateUser'];
        $this->runFunc($actions);
    }

    public function doValidations(){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.'
        ];
    
        $validator = Validator::make($this->mainObject->request, 
            Config::get('validations.updateCorporateUser'), 
            $customMessages);
        if($validator->fails()){
            $this->error =  $validator->errors();
        }
    }

    public function verifyCorporateUser(){
        $this->mainObject->actionList['createUser'] = 0;
        $users = DB::table(Config::get('tables.users'))
        ->whereRaw(" (`MobileNumber`='{$this->mainObject->request['MobileNumber']}' 
         OR `EmailId`='{$this->mainObject->request['EmailId']}') AND UserID <> '{$this->mainObject->request['CorporateUserId']}' ")->get();
        $this->mainObject->actionList['users'] = current($users);
        $usercount = count($this->mainObject->actionList['users']);
        if($usercount == 0){
            $this->mainObject->actionList['createUser'] = 1;   
        }else{
            $this->mainObject->actionList['UserId'] = $this->mainObject->actionList['users'][0]->UserID;
        } 
    }

} 