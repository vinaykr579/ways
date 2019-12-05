<?php
namespace App\Validations;

use Config;
use App\Validations\CommonValidations;
use Illuminate\Support\Facades\DB;
use App\Models\Ride\PaymentInfos;

class BookRideValidations extends CommonValidations{
    
    function action(){
        $actions = Config::get('actionlist.initiateBookRideAndTransactions.validation');
        $this->runFunc($actions);
    }

    function validateTrips(){
        $tripTypeId = $this->mainObject->request['TripTypeId'];
        $vehicleInfo = DB::table(Config::get('tables.vehicles'))
                    ->where([
                        ['VehicleId', '=', $this->property['VehicleId']],
                        ['IsActive', '=', 1]
                    ])->first();
        if(count($vehicleInfo)){
            switch($tripTypeId){
                case Config::get('constants.tripTypes.localSingle'):{
                    if($vehicleInfo->IsCommercial != 1){
                        $this->error = Config::get('errors.invalid_vehicle_for_trip');
                    }    
                }break;    
    
                case Config::get('constants.tripTypes.localPass'):{
                    if($vehicleInfo->IsCommercial != 0){
                        $this->error = Config::get('errors.invalid_vehicle_for_trip');
                    }    
                }break;
                default :
            }
        }else{
            $this->error = Config::get('errors.invalid_vehicle_id');
        }            
    }
            
    function validateBookingOfVehicleOnTollsByAnotherUser(){
        $this->mainObject->actionList['TollIds'] = [];
        $tollNames = [];
        foreach($this->mainObject->request['Rides'] as $ride){
            $tolls = array_column($ride['Tolls'], 'TollId');
            $names = array_column($ride['Tolls'], 'Name');
            $this->mainObject->actionList['TollIds'] = array_merge($this->mainObject->actionList['TollIds'], $tolls);
            $tollNames = array_merge($tollNames, $names);
        }

        if(count($this->mainObject->actionList['TollIds'])){
            $vehicleId = $this->mainObject->actionList['VehicleId'];
            $userId = $this->mainObject->request['UserId'];
            $bookedTolls = $this->mainObject->dbLogic->getAnotherBookingOfVehicleOnTolls($userId, $vehicleId, $this->mainObject->actionList['TollIds']);
            if(count($bookedTolls)){
                $this->mainObject->error = sprintf(Config::get('errors.another_booking_for_vehicle'), $vehicleId, implode(', ', $tollNames));
            }
        }
        
    }
    
    function validateCardDetails(){
        $cardNoRegex = '/
            (?(DEFINE)
                (?<sep> [-]?)
            )
            (?<!\d)(?:
             \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep)  \d{1}                   # 13 digits
            | \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{2}                   # 14 digits
            | \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{3}                   # 15 digit card
            | \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{4}                   # 16 digits
            | \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{1}     # 17 digit card
            | \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{2}     # 18 digit card
            | \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{4} (?&sep) \d{3}     # 19 digit card
            )(?!\d)
        /xu';
        if(!preg_match($cardNoRegex, $this->mainObject->request['PaymentInfo']['AccountNumber'])){
            $this->error = Config::get('errors.invalid_card_no');
        }
        $expiryMm = $this->mainObject->request['PaymentInfo']['Expire_mm'];
        $expiryYy = $this->mainObject->request['PaymentInfo']['Expire_yy'];
        
        if(!preg_match('/[0-1][1-9]/', $expiryMm) || (int)$expiryMm > 12 ){
            $this->error = Config::get('errors.invalid_expiry_month');
        }
        
        if(!preg_match('/\d{2}/', $expiryYy) ){
            $this->error = Config::get('errors.invalid_expiry_year');
        }
        
    }
            
    function validatePaymentInfoId(){        
        if($this->request['PaymentModeId'] == Config::get('constants.payment_mode.card') && count($this->mainObject->request['PaymentInfo'])){
            if($this->validateCardDetails()){                
               $where = " `UserId`='{$this->mainObject->request['User']->UserID}'"
               . " AND `PaymentModeId`='{$this->mainObject->request['PaymentModeId']}' "
               . " AND `AccountNumber`= '{$this->mainObject->request['PaymentInfo']['AccountNumber']}' AND `IsActive` ='1' ";
               $cardInfos = DB::table(Config::get('tables.payment_infos'))->whereRaw($where)->first();
               if(!count($cardInfos) && $this->mainObject->request['SaveCard'] == 1){
                   $paymentInfoObj = new PaymentInfos();
                   $paymentInfoObj->props = $this->mainObject->request;
                   $insertData = prepareData($paymentInfoObj, 
                            Config::get('ridestruct.createPaymentInfo'), 
                            $paymentInfoObj->props);
                   $paymentInfoObj->fill($insertData);
                   $paymentInfoObj->save();
                   $this->mainObject->request['PaymentInfoId'] = $paymentInfoObj->PaymentInfoId;
               }else{
                   $this->mainObject->request['PaymentInfoId'] = $cardInfos->PaymentInfoId;
               }
            }
        }
        
    }
    
    function validateTaxCalculationJsonString(){
        $taxCalculationDetails = json_decode($this->mainObject->request['TaxCalculationDetails'], true);
        //$taxCalculationDetails = fetch($taxCalculationDetailsArr, 'tax', array());
        if(!count($taxCalculationDetails)){ 
            $this->error = Config::get('errors.invalid_request');
            return ;
        }
        
        $taxCalculations = DB::table('TaxCalculation')->where('IsActive', '=', '1')->get();
        $taxCalculationArray = [];
        foreach ($taxCalculations as $taxCalc){
            $taxCalculationArray[$taxCalc->TaxCalculationId] = trim($taxCalc->Description);
        }
        
        $error = 0;
        foreach($taxCalculationDetails as $calculationDetails){
            $calculationId = fetch($calculationDetails, 'id');
            $calculationTitle = fetch($calculationDetails, 'title');
            $taxCalculationTitle = fetch($taxCalculationArray, $calculationId);
            if($taxCalculationTitle != $calculationTitle ){
                $error = 1;
                break;
            }
        }
        if($error == 1){
            $this->error = Config::get('errors.invalid_tax_calculation_details');
            return;
        }
        
    } 
    
    function validateVehicles(){
        $error = [];
        foreach($this->mainObject->request['Vehicles'] as $vehicle){
            $this->mainObject->actionList['VehicleId'] = $vehicle;
            //$this->validateBookingOfVehicleOnTollsByAnotherUser();
            if(!is_null($this->error)){
                $error[] = $this->error;
            }   
        }
    }
}
