<?php
namespace App\BusinessLogic;

use Config;
use App\BusinessLogic\CommonBusinessLogic;
use App\Models\Ride\Rides;
use App\Models\Ride\AssociateRides;
use App\Models\Ride\TollsInRide;
use App\Initialization\SetRideSequenceNo;


class UpdateRideDetailStatus extends CommonBusinessLogic{
    
    public function action(){
        $actions = Config::get('actionlist.updateRideDetailStatus.function');
        $this->runFunc($actions);
    }

    public function updateRidesStatus(){
        $rides = Rides::whereIn('RideId', explode(',', $this->mainObject->request['RideIds']))
        ->where('RideStatus', 'Initiated')->get();
        $rideIds = [];
        $obj = new SetRideSequenceNo();
        foreach($rides as $ride){
            if($ride->RideId){
                $this->updateRideDetailStatus($ride->RideId);
                $rideIds[] = $ride->RideId;
                $this->mainObject->actionList['RideId'] = $ride->RideId;
                $obj->mainObject = $this->mainObject;
                $obj->action();
            }
        }
        if(count($rideIds)){
            $updateArr = [];
            if($this->mainObject->actionList['RideStatus'] =='Booked'){
                $updateArr = [
                    'RideStatus' => $this->mainObject->actionList['RideStatus'],
                    'PaymentStatus' => '1'
                ];
            }else{
                $updateArr = [
                    'RideStatus' => $this->mainObject->actionList['RideStatus']
                ];
            }
            Rides::whereIn('RideId', $rideIds)->update($updateArr);
        }
    }

    public function updateRideDetailStatus($rideId){
        $arides = AssociateRides::where('RideId', $rideId)->get();
        $arideIds = [];
        foreach($arides as $aride){
            $arideIds[] = $aride->AssociateRideId;
        }
        TollsInRide::whereIn('AssociateRideId', $arideIds)->update(['RideStatus' => $this->mainObject->actionList['RideStatus']]);
        AssociateRides::whereIn('AssociateRideId', $arideIds)->update(['RideStatus' => $this->mainObject->actionList['RideStatus']]);
    }

}