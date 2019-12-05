<?php 
namespace App\BusinessLogic;

use App\BusinessLogic\CommonBusinessLogic;
use Config;
use Illuminate\Support\Facades\DB;
use App\Models\Ride\Rides;
use App\Models\Ride\AssociateRides;
use App\Models\Ride\TollsInRide;
use App\Models\Ride\TripType;

class CreateRideForVehicles extends CommonBusinessLogic{

    function action(){
         $actions = ['createIntialObjects', 'setTripTypeDetail','createVehicleRides'];
         $this->runFunc($actions);  
    }

    function createIntialObjects(){
        $this->props['rideObj'] = null;
        $this->props['arideObj'] = new AssociateRides();
        $this->props['trideObj'] = new TollsInRide();
        $this->mainObject->actionList['Bookings'] = [];
    }

    function setTripTypeDetail(){
        $tripType = TripType::find($this->mainObject->request['TripTypeId']);
        $this->mainObject->actionList['TotalRideCount'] = $tripType->NumberOfTrips;
    }

    function createVehicleRides(){
        $actions = ['createRide', 'prepareAssociateRideDecisions', 'handleAssociateRideLogic'];
        foreach($this->mainObject->request['Vehicles'] as $vehicle){
            $this->mainObject->actionList['Vehicle'] = $vehicle;
            $this->runFunc($actions);
            $rideId = $this->props['rideObj']->RideId;
            $tmp = [];
            $tmp['Vehicle'] = $vehicle;
            $tmp['RideId'] = $rideId;
            $this->mainObject->actionList['Bookings'][] = $tmp;
        }
        
        
    }


    function createRide(){
        $rideStr = Config::get('ridestruct.createRide');
        $this->props['rideObj'] = new Rides();
        $this->props['rideObj']->props = $this->mainObject->request;
        $this->props['rideObj']->props['Destination'] = fetch($this->props['rideObj']->props, 'Destination', []);
        $this->props['rideObj']->props['Vehicle'] = $this->mainObject->actionList['Vehicle'];
        $insertData = prepareData($this->props['rideObj'], $rideStr, $this->mainObject->request );
        $this->props['rideObj']->fill($insertData);
        $this->props['rideObj']->save();
    }

    function prepareAssociateRideDecisions(){
        $tripTypeId = $this->mainObject->request['TripTypeId'];
        $this->mainObject->actionList['IsReturn'] = false;
        $this->mainObject->actionList['ReturnRideIds'] = [];
        $this->mainObject->actionList['LaneDirection'] = 'Both';
        $this->mainObject->actionList['TollTripTypeId'] = $this->mainObject->request['TripTypeId'];
        if($tripTypeId == Config::get('constants.tripTypes.return')){
            $this->mainObject->actionList['TollTripTypeId'] = Config::get('constants.tripTypes.single');
        }
        
    }

    function handleAssociateRideLogic(){
        $tripTypeId = $this->mainObject->request['TripTypeId'];
        $this->mainObject->request['ReturnRideIds'] = [];
        $this->createAssociateRides();
        if($tripTypeId == Config::get('constansts.tripTypes.return')){
            $this->mainObject->actionList['LaneDirection'] ='Out';
            $this->mainObject->actionList['IsReturn'] = true;
            $this->createAssociateRides();
        }
    }

    function createAssociateRides(){
        $i = 1;
        $no = 0;
        $returnRideIds = [];
        $this->mainObject->actionList['ReturnTolls'] = [];
        $rides = $this->mainObject->request['Rides'];
        if($this->mainObject->actionList['IsReturn'] === true){
            $rides = array_reverse($this->mainObject->request['Rides'], true);
            $returnRideIds = $this->mainObject->request['ReturnRideIds'];
        }
        $str = Config::get('ridestruct.createAssociateRide');
        $noOfTrips = fetch($this->mainObject->request, 'NoOfTrips', 1);
        while($i <= $noOfTrips){
            foreach($rides as $ride){
                $this->props['arideObj'] = new AssociateRides();
                if(isset($ride['Source']) && isset($ride['Destination'])){
                    if($this->mainObject->actionList['IsReturn'] === true){
                        list($source, $destination) = [$ride['Destination'], $ride['Source']];
                    }else{
                        list($source, $destination) = [$ride['Source'], $ride['Destination']];
                    }
                    $this->props['arideObj']->props['Source'] = $source;
                    $this->props['arideObj']->props['Destination'] = $destination;
                }
                $this->props['arideObj']->props['SequenceNumber'] = $i;
                $this->props['arideObj']->props['BookingSequenceNo'] = ++$no;
                $this->props['arideObj']->props['AssociateRideUniqueId'] = uniqid();
                $insertData = prepareData($this->props['arideObj'], $str,$this->props['arideObj']->props);
                $insertData['RideId'] = $this->props['rideObj']->RideId;
                if($this->mainObject->actionList['IsReturn'] === true){
                    $insertData['IsReturnRideId'] = fetch($returnRideIds, $i);
                }
                $this->props['arideObj']->fill($insertData);
                $this->props['arideObj']->save();
                $this->mainObject->request['ReturnRideIds'][$i] = $this->props['arideObj']->AssociateRideId;
                if($this->mainObject->actionList['IsReturn'] === true){
                    DB::table(Config::get('tables.associate_rides'))
                    ->where('AssociateRideId', $insertData['IsReturnRideId'])
                    ->update(['IsReturnRideId' => $this->props['arideObj']->AssociateRideId]);
                }
                $this->createTollsInRide($ride['Tolls'], $this->mainObject->actionList['IsReturn']);
            }
            $i++;
        }
    }

    function createTollsInRide($tolls = [], $isReturnTolls = false){
        if(!$isReturnTolls){
            $this->mainObject->actionList['ReturnTolls'] = [];
        }
        $tollInRideStr = Config::get('ridestruct.createTollInRide');
        $tollsInride  = [];
        foreach ($tolls as $toll){
            $tollId = $toll['TollId'];
            //$this->mainObject->actionList['VehicleRebateId'] = $toll['RebateId'];
            $toll['TollUniqueId'] = isset($this->mainObject->actionList['ReturnTolls'][$tollId])?$this->mainObject->actionList['ReturnTolls'][$tollId]: uniqid();
            $toll['TollType'] = isset($toll['TollType'])?$toll['TollType']:'1';
            $toll['LaneDirection'] = $this->mainObject->actionList['LaneDirection'];
            $toll['VehicleId'] = $this->mainObject->actionList['Vehicle']['VehicleId'];
            $toll['RideStatus'] = 'initiated';
            $toll['TollPaymentStatus'] = 0;
            $toll['TollTripTypeId'] = $this->mainObject->actionList['TollTripTypeId'];
            $toll['TotalRideCount'] = $this->mainObject->actionList['TotalRideCount'];
            if(!$isReturnTolls){
               $this->mainObject->actionList['ReturnTolls'][$tollId] = $toll['TollUniqueId'];
            }
            $insertData = prepareData($this->props['trideObj'], $tollInRideStr, $toll);
            $insertData['AssociateRideId'] = $this->props['arideObj']->AssociateRideId;
            $tollsInride[] = $insertData;
        }
        TollsInRide::insert($tollsInride);

    }
} 