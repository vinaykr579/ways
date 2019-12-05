<?php
namespace App\Initialization;

use Config;
use App\Models\Ride\Rides;
use App\Models\Ride\AssociateRides;
use App\Models\Ride\TollsInRide;
use App\Models\Vehicles\Vehicles;
use Illuminate\Support\Facades\DB;
use App\Initialization\CommonInitialization;

class RideDetails extends CommonInitialization{
    
    public $rideId, $ride; 
    
    function action(){
        $actions = ['getRideDetails'];
        $this->runFunc($actions);
    }

    public function getRideDetails(){
        $ride = Rides::where('RideId', $this->rideId)->first();
        $ride->AssociateRides = $this->getAssociateRides();
        $ride->RegistrationNumber = $this->getVehicleNumber($ride->VehicleId);
        $this->ride = $ride;
    }

    public function getVehicleNumber($vehicleId){
        $vehicle = Vehicles::where('VehicleId', $vehicleId)->first();
        return $vehicle->RegistrationNumber;
    }

    public function getAssociateRides(){
        $associateRides = AssociateRides::where('RideId', $this->rideId)->get();
        $res = [];
        foreach($associateRides as $aride){
            $aride->Tolls = $this->getTollsInRide($aride->AssociateRideId);
            $res[] = $aride;
        }
        return $res;
    }

    private function getTollsInRide($arideId){
        return DB::table(Config::get('tables.tolls_in_ride').' as t1')
        ->select(['t1.*', 't2.Name'])
        ->join(Config::get('tables.tolls').' as t2', 't1.TollId', '=', 't2.TollId')
        ->where('t1.AssociateRideId', $arideId)->get();
        // return TollsInRide::where('AssociateRideId', $arideId)->get();
    }
}