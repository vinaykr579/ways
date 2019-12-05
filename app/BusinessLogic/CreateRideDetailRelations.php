<?php 
namespace App\BusinessLogic;

use Config;
use App\BusinessLogic\CommonBusinessLogic;
use App\Models\Ride\Transactions;
use App\Models\Ride\Rides;
use App\Models\Ride\AssociateRides;
use App\Models\Ride\TollsInRide;
use App\Models\Ride\RideDetailRelations;

class CreateRideDetailRelations extends CommonBusinessLogic{

    public function action(){
        $actions = ['getRideIds', 'iterateRides'];
        $this->runFunc($actions);
    }

    public function getRideIds(){
        if(empty($this->mainObject->actionList['TransactionId'])){
            $this->error = Config::get('errors.invalid_request');
            return false;
        }
        $this->property['transObj'] = Transactions::find($this->mainObject->actionList['TransactionId']);
        if(empty($this->property['transObj']->RideIds)){
            $this->error = Config::get('errors.invalid_request');
            return false;
        }
    }

    public function iterateRides(){
        $rideIds = explode(',', $this->property['transObj']->RideIds);
        $this->property['rideRelation'] = new RideDetailRelations();
        foreach($rideIds as $rideId){
            $this->property['rideObj'] = Rides::find($rideId);
            $arides = AssociateRides::where('RideId', $rideId)->get();
            foreach($arides as $aride){
                $this->property['aride'] = $aride;
                $this->setRideDetailRelation();
            }
        }
    } 

    public function setRideDetailRelation(){
        $tollsInRide = TollsInRide::where('AssociateRideId', $this->property['aride']->AssociateRideId)->get();
        foreach($tollsInRide as $tride){
            $this->property['tride'] = $tride;
            $this->property['rideRelation']->props = $this->property;
            $insertData = \prepareData($this->property['rideRelation'], Config::get('ridestruct.createRideDetailRelation'), []);
            RideDetailRelations::insert($insertData);
        }
    }


}