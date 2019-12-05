<?php
namespace App\BusinessLogic;

use Config;
use App\BusinessLogic\CommonBusinessLogic;
use App\Models\Common\Corporates;

class UpdateCorporateUserStatus extends CommonBusinessLogic{

    public function action(){
        $actions = ['updateStatus'];
        $this->runFunc($actions);
    }

    public function updateStatus(){
        $obj = Corporates::find($this->mainObject->request['CorporateId']);
        if(!is_null($obj)){
            $obj->fill(['IsActive' => $this->mainObject->request['Status']]);
            $obj->save();
        }else{
            $this->error = Config::get('errors.invalid_request');
        }
        
    }
}