<?php
namespace App\BusinessLogic;

use Config;
use Illuminate\Support\Facades\DB;
use App\BusinessLogic\CommonBusinessLogic;
use App\Models\Common\TollsBetweenLocations;

class TollsBetweenSourceAndDestination extends CommonBusinessLogic {
    
    CONST GOOGLE_DRIVING_API = 'https://maps.googleapis.com/maps/api/directions/json';
    CONST GOOGLE_API_KEY= 'AIzaSyC4vI5mOw08twg4G1UQ7xu76L-_ZYN4iME';
    
    function action() {
        $actions = ['getTollsAndPlylines'];
        $this->runFunc($actions);
    }
    
    function getTollsAndPlylines(){
        if(!empty($this->mainObject->request['TollIds'])){
            $this->property['polyLines'] = [];
            $this->property['TollIds'] = explode(',', $this->mainObject->request['TollIds']);
            $actions = ['getTollsFromTollIds', 'setDefaultTollFare', 'setTollsFare', 'sortTollsToTheirDistance', 'logicForMultipleTrips'];
        }else{
            $this->property['source_name'] = !empty($this->property['Source']['PlaceId'])?'place_id:'.$this->property['Source']['PlaceId']:$this->property['Source']['Name'];
            $this->property['destination_name'] = !empty($this->property['Destination']['PlaceId'])?'place_id:'.$this->property['Destination']['PlaceId']:$this->property['Destination']['Name'];
            $this->property['tolls_between_locations'] = (array)DB::table(Config::get('tables.toll_between_locations'))
            ->whereRaw(" (`Location1` = '{$this->property['source_name']}' AND `Location2` = '{$this->property['destination_name']}') ")
            ->first();
            if(!count($this->property['tolls_between_locations'])){
                $actions = ['getWaypointAndPolylinesBtwLocations', 'getLyingTollsOnWayPoints', 'setDefaultTollFare',
                 'setTollsFare', 'sortTollsToTheirDistance', 'createEntryForTollsBetweenLocations'];
            }else{
                $this->property['polyLines'] = json_decode($this->property['tolls_between_locations']['Polylines'], true);
                $this->property['TollIds'] = explode(',', $this->property['tolls_between_locations']['TollIds']);
                $actions = ['getTollsFromTollIds', 'setDefaultTollFare', 'setTollsFare', 'sortTollsToTheirDistance'];
            }
            
        }   
        $this->runFunc($actions);
    }
    
    function getWaypointAndPolylinesBtwLocations(){
        $apiResponse = json_decode(curlGetRequest(self::GOOGLE_DRIVING_API
                .'?origin='.urlencode($this->property['source_name']).'&destination='.urlencode($this->property['destination_name']).'&key='.self::GOOGLE_API_KEY) , true);
        $routesArray = $apiResponse['routes'];
        $routeLegs = $routesArray[0]['legs'];
        $this->property['waypoints'] = []; 
        $this->property['polyLines'] = [];
        if(count($routeLegs)){
            foreach ($routeLegs as $key=>$value){
                $stepsArr = isset($value['steps'])?$value['steps']:array();
                foreach($stepsArr as $k=>$v){
                    $polylinePoints = $v['polyline']['points'];
                    if(!empty($polylinePoints)){
                        $this->property['polyLines'][] = $polylinePoints;
                        $this->property['waypoints'][] = decodeWayPoints($polylinePoints);
                    }
                }
            }           
        }
        
    }
    
    function getLyingTollsOnWayPoints(){
        $tollsArray = DB::table(Config::get('tables.tolls').' AS t1')
        ->select(['t1.TollId','t1.Name','t1.IsActive', 't1.Latitude',
         't1.Longitude', 't2.Name As State'])
        ->join(Config::get('tables.state').' AS t2', 't1.StateId', '=', 't2.StateId')
        ->get();
        $resultTolls = [];
        $tollIds = [];
        foreach($tollsArray as $toll){                    
            $lat = number_format($toll->Latitude, 3);
            $lng = number_format($toll->Longitude, 3);
            if($this->checkLatAndLngPresentInArray($this->property['waypoints'] , $lat , $lng)){
                $resultTolls[] = $toll;
                array_push($tollIds, $toll->TollId);
            }
        }
        
        $this->property['tolls'] = $resultTolls;
        $this->property['TollIds'] = $tollIds;
        
    }
    
    
    function sortTollsToTheirDistance(){
        if(count($this->property['tolls'])){
            $resTolls = [];
            $distance = 0;
            foreach ($this->property['tolls'] as $toll){
                if(isset($this->property['Source'])){
                    $distance = distanceBetweenTwoLatAndLang($this->property['Source']['Latitude'], $this->property['Source']['Longitude'],
                    $toll->Latitude, $toll->Longitude, 'K');
                }
                $toll->Distance = $distance;
                $toll->IsSelected = 1;
                $toll->TollFare = $this->getTollFare($toll->TollId);
                $toll->LaneDirection = $this->mainObject->actionList['LaneDirection'];
                $resTolls[] = $toll;
            }
            usort($resTolls, function ($a, $b){
                return $a->Distance >= $b->Distance?TRUE:FALSE;
                
            });
            
            $this->property['tolls'] = $resTolls;
        }
    }
    
    
    function getTollFare($tollId){
        $fare = fetch($this->property['tollFares'], $tollId, $this->property['defaultTollFare']);
        return $fare;
    }
    
    function createEntryForTollsBetweenLocations(){
        $insertData = [];
        $insertData['Location1'] = $this->property['source_name'];
        $insertData['Location2'] = $this->property['destination_name'];
        $insertData['TollIds'] = implode(',', $this->property['TollIds']);
        $insertData['Polylines'] = json_encode($this->property['polyLines']);
        $tollsBtwnObj = new TollsBetweenLocations();
        $tollsBtwnObj->fill($insertData);
        $tollsBtwnObj->save();
    }
    
    function setDefaultTollFare(){
        $this->property['defaultTollFare'] = fetch($this->mainObject->request, 'PAYGAmount', 0);
        $tripTypeId = $this->mainObject->request['TripTypeId'];
        if($tripTypeId == Config('constants.tripTypes.payg') && $this->property['defaultTollFare'] == 0){
            $payAsYouGoAmtDetail = DB::table(Config::get('tables.payasyougoselectionamount'))
            ->first();
            $this->property['defaultTollFare'] = $payAsYouGoAmtDetail->Amount?$payAsYouGoAmtDetail->Amount:0;
        }
    }
    
    function setTollsFare(){
        $this->property['tollFares'] = [];
        if(!empty($this->property['TollIds'])){
            $tripTypeId = $this->mainObject->request['TripTypeId'];
            if($tripTypeId == Config::get('constants.tripTypes.return')){
                $tripTypeId = Config::get('constants.tripTypes.single');
            }

            $tollFares = DB::table(Config::get('tables.toll_fare'))
                        ->where([
                            ['VehicleTypeId', '=', $this->mainObject->request['VehicleTypeId']],
                            ['TripTypeId', '=', $tripTypeId],
                            ['IsActive', '=', '1']
                        ])
                        ->whereIn('TollId', $this->property['TollIds'])->get();

            foreach($tollFares as $tf ){
                $tollId = $tf->TollId;
                $amount = $tf->Amount;
                $this->property['tollFares'][$tollId] = $amount;
            }

        }
        
    }
    
    function checkLatAndLngPresentInArray(array $points, float $lat, float $lng){
        $found = false;
        foreach($points as $key=>$value){
            foreach ($value as $k=>$v){
                if($lat == number_format($v[0],3) && $lng == number_format($v[1],3)){
                    $found = true;
                    break;
                }
            }
        }
        return $found;
    } 
    
    function getTollsFromTollIds(){
        $this->property['tolls'] = [];
        if(!empty($this->property['TollIds'])){
            $this->property['tolls'] = DB::table(Config::get('tables.tolls').' AS t1')
                                        ->join(Config::get('tables.state').' AS t2', 't1.StateId', '=', 't2.StateId')
                                        ->select(['t1.TollId','t1.Name','t1.IsActive', 't1.Latitude', 't1.Longitude', 't2.Name As State'])
                                        ->whereIn('t1.TollId', $this->property['TollIds'])
                                        ->get();                    
        }
        
    }
    
   
    function logicForMultipleTrips(){
        if(count($this->property['tolls'])){
            $tollObj = current($this->property['tolls']);
            $this->property['tolls'] = array_fill(0, fetch($this->mainObject->request,'NoOfTrips', 1), $tollObj);
        }
    }
    

}