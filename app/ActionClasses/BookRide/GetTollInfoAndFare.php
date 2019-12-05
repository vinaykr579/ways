<?php 
namespace App\ActionClasses\BookRide;

use Illuminate\Support\Facades\DB;
use Validator;
use Config;
use App\ActionClasses\Repo;

class GetTollInfoAndFare extends Repo  {

    function action(){
        $actions = Config::get('actionlist.gettollinfoandfare.function');
        $this->runFuns($actions);
        $actionClasses = Config::get('actionlist.gettollinfoandfare.action');
        $this->runActions($actionClasses);
    }

    function doValidations(){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.'
        ];
    
        $validator = Validator::make($this->request, 
            Config::get('validations.getTollInfoAndFare'), 
            $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
        
    }

    function createResponse(){
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
                    'Rides' => $this->actionList['Rides']
                ]
            ];
        }
    }

}


