<?php 
namespace App\Validations;

use Config;
use App\Validations\CommonValidations;
use Illuminate\Support\Facades\DB;
use App\Models\Ride\Rides;
use App\Models\Ride\Transactions;
use App\Utils\RazorpayUtils;

class UpdateRideStatusValidations extends CommonValidations{

    function action(){
        $actions = ['validateRides', 'verifyTransactionPayment'];
        $this->runFunc($actions);
    }

    function validateRides(){
        $rides = Rides::whereIn('RideId', explode(',', $this->mainObject->request['RideIds']))
            ->where('RideStatus', 'Initiated')->get();
        // if(!count($rides)){
        //     $this->error = Config::get('errors.invalid_rides');
        // }
    }

    function verifyTransactionPayment(){
        $transaction = Transactions::where('TransactionId', $this->mainObject->request['TransactionId'])
        ->first();
        $razorpayId = $this->mainObject->request['RazorPaymentId'];
        $rzp = new RazorpayUtils();
        $status = $rzp->verifyOrderStatus($transaction->RazorpayOrderId, $razorpayId);
        if($status !== 'success'){
            $this->error = Config::get('errors.invalid_payment');
        }
    }
}