<?php 
namespace App\ActionClasses\BookRide;

use Illuminate\Support\Facades\DB;
use Validator;
use Config;
use App\ActionClasses\Repo;

class InitiateBookRideAndTransactions extends Repo{

    function action(){
        $actions = Config::get('actionlist.initiateBookRideAndTransactions.function');
        if(is_null($this->error)){
            $this->runFuns($actions);
        }
    }

    function doValidations(){
        $customMessages = [
            'required' => 'The :attribute key can not be blank.'
        ];
    
        $validator = Validator::make($this->request, 
            Config::get('validations.initiateBookRideAndTransactions'), 
            $customMessages);
        if($validator->fails()){
            $this->error = $validator->errors();
        }
        
    }

    function createRideForEachVehicle(){
        $actions = Config::get('actionlist.initiateBookRideAndTransactions.action');
        $this->runActions($actions);
    }

    // function createOrder(){
    //     $rzp = new RazorpayUtils();
    //     $order = $rzp->createOrder($this->actionList['TransactionId'], $this->request['PayableAmount']);
    //     return isset($order->id)?$order->id:null;
    // }

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
                    'Bookings' => $this->actionList['Bookings'],
                    'TransactionId' => $this->actionList['TransactionId'],
                    'PayableAmount' => $this->request['PayableAmount'],
                    'OrderId' => $this->actionList['OrderId']
                ]
            ];
        }
    }
}
