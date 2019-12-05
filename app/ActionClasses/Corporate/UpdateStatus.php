<?php 
namespace App\ActionClasses\Corporate;

use Illuminate\Support\Facades\DB;
use App\ActionClasses\Repo;
use Config;
use Validator;

class UpdateStatus extends  Repo {

    public function action(){
        $actionClasses = Config::get('actionlist.updateCorporateUserStatus.action');
        $this->runActions($actionClasses);
    }

    function doValidations(){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.'
        ];
    
        $validator = Validator::make($this->request, 
            Config::get('validations.updateCorporateUserStatus'), 
            $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
        
    }

    public function createResponse(){
        if(!is_null($this->error)){
            return [
                'status' => 200,
                'message' => 'error',
                'response' => [
                    'error' => $this->error
                ]
            ];
        }else{
            return [
                'status' => 200,
                'message' => 'success',
                'response' => [
                    'message' => 'Corporate user has been updated.'
                ]
            ];
        }
    }

}
    