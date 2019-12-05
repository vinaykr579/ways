<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActionClasses\BookRide\GetMasterData;
use App\ActionClasses\BookRide\GetTollInfoAndFare;
use App\ActionClasses\BookRide\InitiateBookRideAndTransactions;
use App\ActionClasses\BookRide\UpdateTransactionPaymentStatus;
use App\ActionClasses\BookRide\GetUserBookings;


class BookRideController extends Controller
{
    function masterData(Request $request){
        $obj = new GetMasterData($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }


    function getTollInfoAndFare(Request $request){  
        $obj = new GetTollInfoAndFare($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    function initiateBookRideAndTransactions(Request $request){
        $obj = new InitiateBookRideAndTransactions($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    function updateTransactionPaymentStatus(Request $request){
        $obj = new UpdateTransactionPaymentStatus($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }

    function getUserBookings(Request $request){
        $obj = new GetUserBookings($request->all());
        $obj->action();
        return response()->json($obj->getResponse());
    }
}