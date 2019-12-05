<?php 
namespace App\BusinessLogic;

use Config;
use App\BusinessLogic\CommonBusinessLogic;
use App\Models\Ride\Transactions;
use App\Initialization\RideDetails;
use App\Utils\CreateTollFareAndTransactions;

class CreateAccountingEntry extends CommonBusinessLogic{

    function action(){
        $this->createEntry();
    }

    function createEntry(){
       $transaction = Transactions::find($this->mainObject->request['TransactionId']);
       $rides = explode(',', $transaction->RideIds);
       if(is_array($rides) && count($rides)){
           $rideDetailObj = new RideDetails();
           $ctftObj = new CreateTollFareAndTransactions();
           $ctftObj->props['transaction'] = $transaction;
           $ctftObj->props['identityType'] = Config::get('constants.account.booking_entry');
           $ctftObj->props['UserId'] = $this->mainObject->request['User']->UserID;
           foreach($rides as $rideId){
                $rideDetailObj->rideId = $rideId;
                $rideDetailObj->action();
                $ride = $rideDetailObj->ride;
                $ctftObj->props['ride'] = $ride;
                $ctftObj->action();
           }
       }
    }
}