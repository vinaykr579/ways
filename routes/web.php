<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login/{path?}', function(){
    return view('welcome');
});

Route::prefix('/registration')->group(function () {
    Route::get('/', function(){
        return view('registration');
    });
    Route::get('/verify-email/{token}', 'VerifyEmail@index');
});

Route::post('/password/reset', 'API\PasswordResetController@reset');

Route::prefix('/register')->group(function(){
    Route::post('/', 'API\RegistrationController@index');
    Route::post('/verify-otp', 'API\RegistrationController@verifyOTP');
    Route::post('/set-password', 'API\RegistrationController@setPassword');
    Route::get('/verify-email/{token}', 'API\RegistrationController@verifyEmail');
      
});

//Route::post('/register', 'API\RegistrationController@index');
Route::post('/save-contact-form', 'API\ContactForm@index');
Route::get('/privacy', function(){
    return view('privacy-policy');
});
URL::forceScheme('https');
