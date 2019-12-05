<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'API\LoginController@index');
Route::post('/password/forgot', 'API\PasswordResetController@create');
Route::get('/sendemail', 'API\PasswordResetController@sendEmail');
Route::get('/qrcode', 'API\QRCodeController@getQrCode');
Route::get('/qrcstatus', 'API\QRCodeController@qrCStatus');
Route::group(['middleware' => ['auth', 'jwtpayload']],function(){
    Route::get('/getDashboard', 'API\DashboardController@index');
    Route::get('/getMasterData', 'API\BookRideController@masterData');
    Route::post('/getTollInfoAndFare', 'API\BookRideController@getTollInfoAndFare');
    Route::post('/initiateBookRideAndTransactions', 'API\BookRideController@initiateBookRideAndTransactions');
    Route::post('/updateTransactionWithConfirmRide', 'API\BookRideController@updateTransactionPaymentStatus');
    Route::get('/getBookings', 'API\BookRideController@getUserBookings');
    Route::post('/addCorporateUser', 'API\CorporateUserController@add');
    Route::post('/updateCorporateUser', 'API\CorporateUserController@update');
    Route::get('/getCorporateUsers', 'API\CorporateUserController@show');
    Route::put('/updateCorporateUserStatus', 'API\CorporateUserController@updateStatus');
});
URL::forceScheme('https');

