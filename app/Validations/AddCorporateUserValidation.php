<?php
namespace App\Validations;

use Config;
use Validator;
use App\Validations\CommonValidations;
use Illuminate\Support\Facades\DB;

class AddCorporateUserValidation extends CommonValidations{
    
    public function action(){
        $actions = ['doValidations', 'verifyCorporateUser'];
        $this->runFunc($actions);
    }

    public function doValidations(){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.'
        ];
    
        $validator = Validator::make($this->mainObject->request, 
            Config::get('validations.addCorporateUser'), 
            $customMessages);
        if($validator->fails()){
            $this->error =  $validator->errors();
        }
    }

    public function verifyCorporateUser(){
        $users = DB::table(Config::get('tables.users'))
        ->whereRaw(" `MobileNumber`='{$this->mainObject->request['MobileNumber']}' 
         OR `EmailId`='{$this->mainObject->request['EmailId']}' ")->get();
        $this->mainObject->actionList['users'] = current($users);
        $usercount = count($this->mainObject->actionList['users']);
        $this->mainObject->actionList['createUser'] = 0;
        if($usercount > 1){
           $this->error = Config::get('errors.mobileno_and_email_associated_with_different_user');
        }else{
             $this->verifyUserEmailAndPhone();   
        } 
    }

    public function verifyUserEmailAndPhone(){
        if(count($this->mainObject->actionList['users']) == 1){
            $this->mainObject->actionList['user'] = current($this->mainObject->actionList['users']);   
            $mobileNoheck = $this->mainObject->actionList['user']->MobileNumber == $this->mainObject->request['MobileNumber'];
            $emailIdCheck = $this->mainObject->actionList['user']->EmailId == $this->mainObject->request['EmailId'];
            if(!($mobileNoheck && $emailIdCheck)){
                $this->error = Config::get('errors.mobileno_and_email_associated_with_different_user');
                return ;
            }
            $this->mainObject->actionList['UserId'] = $this->mainObject->actionList['user']->UserID;
        }else{
            $this->mainObject->actionList['createUser'] = 1;
        }
    }
} 