<?php
namespace App\ActionClasses\Dashboard;

use Illuminate\Support\Facades\DB;
use App\ActionClasses\Repo;


class Dashboard extends Repo{

    function action(){
        $actions = ['calculateBookedRide', 'getBookedToll'];
        $this->runFuns($actions);
    }

    function calculateBookedRide(){
        $bookedRide = DB::table('Rides')
            ->selectRaw(" SUM(CASE WHEN RideStatus = 'Booked' THEN 1 ELSE 0 END) AS bookedRide 
            , SUM(CASE WHEN RideStatus = 'Ongoing' THEN 1 ELSE 0 END) AS ongoingRide
            , COUNT(DISTINCT VehicleId) AS bookedVehicle
            , SUM(PaidAmount) AS amountPaid ")
            ->where([
                ['UserID', '=', $this->request['User']->UserID],
                ['PaymentStatus', '=', '1']
            ])
            ->first();
        $this->props['dashboard'] = (array)$bookedRide;
    }


    function getBookedToll(){
        $res = DB::table('Rides')
        ->selectRaw('COUNT(DISTINCT TollsInRide.TollId) AS bookedToll')
        ->join('AssociateRides', 'Rides.RideId', '=', 'AssociateRides.RideId')
        ->join('TollsInRide', 'AssociateRides.AssociateRideId', '=', 'TollsInRide.AssociateRideId')
        ->where([
            ['Rides.UserID', '=', $this->request['User']->UserID],
            ['Rides.PaymentStatus', '=', '1']
        ])
        ->whereIn('Rides.RideStatus', ['Booked', 'Ongoing'])
        ->first();
        $this->props['dashboard']['bookedTolls'] = $res->bookedToll;
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
                'response' => $this->props['dashboard']
            ];
        }
        
    }

}
