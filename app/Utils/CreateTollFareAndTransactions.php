<?php 
namespace App\Utils;

use Config;
use App\Models\Common\GenerateVoucherNo;
use App\Models\Ride\TollFareAndTransactions;

class CreateTollFareAndTransactions{
    public $props = [];

    function action(){
        $this->createEntryForTransactions();
        $this->createEntryForBookings();
    }

    function setEntryId(){
        $this->props['EntryId'] = uniqid();
    }

    function setVoucherNo(){
        $obj = new GenerateVoucherNo();
        $obj->save();
        $this->props['VoucherNo'] = $obj->VoucherNo;
    }

    function initiateEntry(){
        $this->setEntryId();
        $this->setVoucherNo();
    }

    function createEntryForBookings(){
        $this->iterateThroughTollsInRide();
    }

    function iterateThroughTollsInRide(){
        if(count($this->props['ride']->AssociateRides)){
            foreach($this->props['ride']->AssociateRides as $aride){
                if(is_array($aride->Tolls)){
                   $this->createEntryForTollsInRide($aride);
                }
            }
        }
    }

    function createEntryForTollsInRide($aride){
        foreach($aride->Tolls as $tride){
            $this->initiateEntry();
            $this->props['DebitAccount'] = Config::get('constants.account.ways');
            $this->props['CreditAccount'] = 't-'.$tride->TollInRideId;
            $this->props['TollId'] = $tride->TollInRideId;
            $this->props['Amount'] = $tride->TollFare;
            $this->props['FLowType'] = 1;
            $this->createEntry();
            $this->props['FLowType'] = 2;
            $this->createEntry();
        }    
    }

    function createEntryForTransactions(){
        $this->initiateEntry();
        $this->props['DebitAccount'] = Config::get('constants.account.ways_user_payment');
        $this->props['CreditAccount'] = Config::get('constants.account.ways');
        $this->props['Amount'] = $this->props['transaction']->Amount;
        $this->props['FLowType'] = 1;
        $this->createEntry();
        $this->props['FLowType'] = 2;
        $this->createEntry();
    }

    function createEntry(){
        $insertObj = new TollFareAndTransactions();
        $insertObj->props = $this->props;
        $insertData = prepareData($insertObj, [], $this->props);
        $insertObj->fill($insertData);
        $insertObj->save();
    }



}