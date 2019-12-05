<?php
namespace App\Initialization;

use Config;
use Illuminate\Support\Facades\DB;
use App\Initialization\CommonInitialization;
use App\Models\Ride\Rides;
use App\Models\Ride\RideDetailRelations;

class SetRideSequenceNo extends CommonInitialization{ 
    //put your code here
    
    function action() {
        $actions = ['updateRideSequenceNo'];
        $this->runFunc($actions);
    }
    
    function updateRideSequenceNo(){
        $rideSequenceNo = $this->calcRideSequenceNo();
        Rides::where('RideId',$this->mainObject->actionList['RideId'])
        ->update(['RideSequenceNo'=> $rideSequenceNo]);
        RideDetailRelations::where('RideId',$this->mainObject->actionList['RideId'])
        ->update(['RideSequenceNo'=> $rideSequenceNo, 'MigrationStatus' => '1']);
    }
    
    

    function calcRideSequenceNo(){
        $query = "SELECT MAX(RideSequenceNo) As CurrentSequenceNo FROM ".Config::get('tables.rides')." WHERE UserID = {$this->mainObject->request['User']->UserID}";
        $result = DB::select(DB::raw($query));
        return $result[0]->CurrentSequenceNo+1; 
    }
}
