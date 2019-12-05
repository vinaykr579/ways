<?php 
namespace App\ActionClasses\BookRide;

use Illuminate\Support\Facades\DB;
use App\ActionClasses\Repo;
use Config;

class GetMasterData extends  Repo {
    
    function action(){
        $actionList = ['getTripType', 'getVehicleType', 'getVehicles',
         'getTaxCalculationData', 'getNetBankingSupportedBanks', 'getTolls',
          'getPAYGSelectionAmount'];
        $this->runFuns($actionList);
    }

    function getTripType(){
       // DB::enableQueryLog();
        $this->props['tripTypes'] = DB::table(Config::get('tables.trip_type'))
        ->where([
            ['IsActive', '=', '1'],
            ['IsHidden', '=', '0'],
            ['TripTypeId', '!=', '10']
         ])
        ->whereIn('PlatformSupported', ['app','all']) 
        ->orderBy('SequenceNo', 'asc') 
        ->get();
        //$this->props['laquery'] = DB::getQueryLog();
    }

    function getVehicleType(){
        $this->props['vehicleTypes'] = DB::table(Config::get('tables.vehicle_types'))
        ->where([
            ['IsActive', '=', '1']
         ])
        ->orderBy('SequenceNo', 'asc') 
        ->get();
    }

    function getVehicles(){
        $this->props['vehicles'] = DB::table(Config::get('tables.user_vehicles').' as t1')
        ->select(['t2.VehicleId','t2.RegistrationNumber', 't2.VehicleType' ])
        ->join(Config::get('tables.vehicles').' as t2', 't1.VehicleId', '=', 't2.VehicleId')
        ->where([
            ['t2.IsActive', '=', '1'],
            ['t1.UserId', '=', $this->request['User']->UserID],
         ])
        ->orderBy('t1.UserVehicleId', 'desc') 
        ->get();
    }

    function getTaxCalculationData(){
        $this->props['taxCalculations'] = DB::table(Config::get('tables.taxcalculation'))
        ->select(['TaxCalculationId', 'Description', 'TaxValue', 'ValueType', 'Level'])
        ->orderBy('Level', 'ASC')
        ->get();    
    }

    function getNetBankingSupportedBanks(){
        $this->props['netbanking_banks'] = Config::get('netbanking_banks');
    }

    function getTolls(){
       $this->props['tolls'] = DB::select(DB::raw($query = "SELECT t1.TollId, t1.Name, t1.Latitude, t1.Longitude, t1.EffectiveDate, t1.IsActive , t1.TollType ,"
        . " t2.Name as State, t1.EmailId, t1.CreatedOnDate, t1.LandlineNumber AS PhoneNumber, t1.AddressId As Address "
        . " ,(SELECT CONCAT(GROUP_CONCAT(DISTINCT TripTypeId), ',',3, ',',11) FROM ".Config::get('tables.toll_fare')." WHERE TollId = t1.TollId ) As SupportedTripTypes "
        . " ,(SELECT GROUP_CONCAT(DISTINCT VehicleTypeId) FROM ".Config::get('tables.toll_fare')." WHERE TollId = t1.TollId ) As SupportedVehicleTypes "
        . "  FROM ".Config::get('tables.tolls')." t1 INNER JOIN ".Config::get('tables.state')." t2 ON t1.StateId = t2.StateId ORDER BY t1.Name ASC"));   
    }

    function getPAYGSelectionAmount(){
        $this->props['paygSelectionAmounts'] = DB::table(Config::get('tables.payg_selection_amount'))->get();
    }

    function createResponse(){
        if(!is_null($this->error)){
            return [
                'status' => 200,
                'message' => 'error',
                'response' => [
                    'error' => $this->error
                ]
            ];
        }else{
            return [
                'status' => 200,
                'message' => 'success',
                'response' => $this->props
            ];
        }
    }
}