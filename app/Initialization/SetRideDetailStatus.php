<?php
namespace App\Initialization;

use Config;
use App\Initialization\CommonInitialization;

class SetRideDetailStatus extends CommonInitialization{

    public function action(){
        $actions = ['setRideStatus', 'setTransactionStatus'];
        $this->runFunc($actions);
    }

    public function setRideStatus(){
        $this->mainObject->actionList['RideStatus'] = $this->mainObject->request['Status'] == 'Success'
                                                ?Config::get('constants.rideStatus.booked')
                                                :Config::get('constants.rideStatus.paymentfailed');
    }


    public function setTransactionStatus(){
        $this->mainObject->actionList['TransactionStatus'] = $this->mainObject->request['Status'];
        $this->mainObject->actionList['PaymentStatus'] = $this->mainObject->request['Status'] == 'Succees'
                                                        ?1:0;
    }


}