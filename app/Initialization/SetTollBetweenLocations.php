<?php
namespace App\Initialization;

use Config;
use Illuminate\Support\Facades\DB;
use App\Initialization\CommonInitialization;
use App\BusinessLogic\TollsBetweenSourceAndDestination;

class SetTollBetweenLocations extends CommonInitialization{
    //put your code here
    
    function action() {
        $actions = Config::get('actionlist.settollbetweenlocations.function');
        $this->runFunc($actions);
    }
    
    function calculateTollsBetweenLocations(){
        $this->property['Rides'] = [];
        if($this->mainObject->request['TripTypeId'] == Config::get('constants.tripTypes.return')){
            $this->mainObject->actionList['LaneDirection'] = 'Single';
        }else{
            $this->mainObject->actionList['LaneDirection'] = '';
        }
        $obj = new TollsBetweenSourceAndDestination();
        $obj->mainObject = $this->mainObject;
        if(!empty($this->mainObject->request['TollIds'])){
            $obj->action();
            $ride = [];
            $ride['Tolls'] = $obj->property['tolls'];
            $this->property['Rides'][] = $ride;
        }else{
            foreach ($this->mainObject->request['Rides'] as $ride){
                $obj->property = $ride;
                $obj->action();
                $ride['Tolls'] = $obj->property['tolls'];
                $ride['Polylines'] = $obj->property['polyLines'];
                $this->property['Rides'][] = $ride;
            }
            
        }
        
        if($this->mainObject->request['TripTypeId'] == Config::get('constants.tripTypes.return')){
            $this->calculateReturnTollsBetweenLocations($obj);
        }
        $this->mainObject->actionList['Rides'] = $this->property['Rides'];
    }
    
    function calculateReturnTollsBetweenLocations($obj){
        foreach ($this->mainObject->request['Rides'] as $ride){
            $source = $ride['Source'];
            $ride['Source'] = $ride['Destination'];
            $ride['Destination'] = $source;
            $obj->property = $ride;
            $obj->action();
            $ride['Tolls'] = $obj->property['tolls'];
            $ride['Polylines'] = $obj->property['polyLines'];
            $this->property['Rides'][] = $ride;
        }
    }
    
    
    function getMinimumBalanceForAutoTopUp(){
        $tollIds = fetch($this->mainObject->request,'TollIds', '');
        if(!empty($tollIds) && !is_array($tollIds)){
            $tollIds = explode(',', $tollIds);
        }
        $amount = 0;
        if(!empty($this->mainObject->request['TollIds'])){
            $result = DB::table(Config::get('tables.toll_fare'))
            ->select(['Amount'])->where([
                ['VehicleTypeId', '=', $this->mainObject->request['VehicleTypeId']],
                ['TripTypeId', '=', Config::get('constants.tripTypes.single')]
                ])
            ->whereIn('TollId',$tollIds)
            ->first();
            $amount = $result->Amount;
        }
        $this->mainObject->actionList['MinimumBalanceForAutoTopUp'] = $amount;
    }
}
