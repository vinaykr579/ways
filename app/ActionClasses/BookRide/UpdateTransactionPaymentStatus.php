<?php
namespace App\ActionClasses\BookRide;

use Config;
use Validator;
use App\ActionClasses\Repo;
use App\Initialization\RideDetails;

class UpdateTransactionPaymentStatus extends Repo{

    function action(){
        $actions = Config::get('actionlist.updateTransactionPaymentStatus.function');
        $this->runFuns($actions);
    }

    function doValidations(){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.'
        ];
    
        $validator = Validator::make($this->request, 
            Config::get('validations.updateTransactionPaymentStatus'), 
            $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
        
    }

    function updateRideDetailStatus(){
        $actionList = Config::get('actionlist.updateTransactionPaymentStatus.action');
        $this->runActions($actionList);
    }

    function getConfirmedRidesDetail(){
        $rideIds = explode(',', $this->request['RideIds']);
        $rideDetailObj = new RideDetails();
        $res = [];
        foreach($rideIds as $rideId){
            $rideDetailObj->rideId = $rideId;
            $rideDetailObj->action();
            $res[] = $rideDetailObj->ride;
        }
        return $res;
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
                'status'=> 200,
                'message'=> 'success',
                'response'=>[
                    'rides' => $this->getConfirmedRidesDetail(),
                    'transaction'=> $this->actionList['Transaction']
                ]
            ];
        }
    }

}