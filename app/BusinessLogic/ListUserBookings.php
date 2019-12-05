<?php 
namespace App\BusinessLogic;
use App\BusinessLogic\CommonBusinessLogic;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Ride\Rides;
use App\Models\Ride\AssociateRides;
use App\Models\Ride\TollsInRide;
use App\Models\Ride\Transactions;
use App\Initialization\RideDetails;
use Config;


class ListUserBookings extends CommonBusinessLogic{

    public function action(){
        $actions  = Config::get('actionlist.listUserBookings.function');
        $this->runFunc($actions);
    }

    public function listUserTransactions(){
        return Transactions::where([
            ['UserId', $this->mainObject->request['User']->UserID],
            ['Status', 'Success'],
        ])->orderBy('TransactionId', 'DESC')->paginate(5);
                
    }

    public function getVehicleBookings($rideIds){
        return DB::table(Config::get('tables.rides').' AS t1')
        ->join(Config::get('tables.vehicles').' AS t2', 't1.VehicleId', '=', 't2.VehicleId' )
        ->select(['t1.VehicleId', 't2.RegistrationNumber', 't1.TotalAmount'])
        ->whereIn('RideId', explode(',', $rideIds))->get();
    }

    public function userBookings(){
        $transactions = $this->listUserTransactions();
        $this->mainObject->actionList['Bookings'] = [];
        $this->mainObject->actionList['TotalRecords'] = $transactions->total();
        if(count($transactions)){
            $rideObj = new RideDetails();
            foreach($transactions as $transaction){
                $rideId = explode(',',$transaction->RideIds)[0];
                $rideObj->rideId = $rideId;
                $rideObj->action();
                $rideDetails = $rideObj->ride;
                $bookingDetails = [];
                $bookingDetails['Transaction'] = $transaction;
                $bookingDetails['Ride'] = $rideDetails;
                $bookingDetails['VehicleBookings'] = $this->getVehicleBookings($transaction->RideIds);
                $this->mainObject->actionList['Bookings'][] = $bookingDetails;
            }
        }
    }
}