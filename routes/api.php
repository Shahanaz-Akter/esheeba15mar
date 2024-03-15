<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('token-validation', function(Request $reqeust){

    return response()->json($reqeust->user());

})->middleware('auth:sanctum');

Route::get('/myinfo', 'ProfileController@myinfo')->middleware('auth:sanctum');

Route::post('/register', 'AuthController@register');

Route::post('/login', 'AuthController@login')->name('login');

Route::post('/logout', 'AuthController@logout')->middleware('auth:sanctum');

Route::post('/verifyotp', 'AuthController@verifyotp');

Route::post('/resendotp/{for}', 'AuthController@resendotp');

Route::post('/sendotp_changepassword', 'AuthController@sendotp_changepw')->middleware('auth:sanctum');

Route::post('/resendotp_changepassword', 'AuthController@resendotp_changepw')->middleware('auth:sanctum');

Route::post('/verifyotp_changepassword', 'AuthController@verifyotp_changepw')->middleware('auth:sanctum');

Route::post('/changepassword', 'AuthController@changepw')->middleware('auth:sanctum');

Route::post('/forgotpassword', 'AuthController@forgotpassword');

Route::post('/forgotpassword_verifyotp/{token}', 'AuthController@forgotpassword_verifyotp');

Route::post('/forgotpassword_resetpassword/{token}', 'AuthController@forgotpassword_resetpassword');

Route::get('/servicecategories', 'ServiceController@servicecategories')->middleware('auth:sanctum');

Route::get('/getads', 'MiscController@ads')->middleware('auth:sanctum');

Route::get('/services/{categoryid}', 'ServiceController@services')->middleware('auth:sanctum');

Route::get('/checkcoupon/{coupon}', 'ReferController@checkcoupon')->middleware('auth:sanctum');

Route::get('/generaterefer', 'ReferController@generaterefer')->middleware('auth:sanctum');

Route::get('/myrefercode', 'ReferController@myrefercode')->middleware('auth:sanctum');

Route::post('/makeappointment', 'AppointmentController@makeappointment')->middleware('auth:sanctum');

Route::get('/pendinglist', 'AppointmentController@pendinglist')->middleware('auth:sanctum');

Route::get('/completedlist', 'AppointmentController@completedlist')->middleware('auth:sanctum');

Route::get('/cancelledlist', 'AppointmentController@cancelledlist')->middleware('auth:sanctum');

Route::get('/appointmentdetails/{invoice}', 'AppointmentController@appointmentdetails')->middleware('auth:sanctum');

Route::get('/scheduledetails/{invoice}', 'AppointmentController@scheduledetails')->middleware('auth:sanctum');

Route::get('/markascomplete/{invoice}', 'AppointmentController@markascomplete')->middleware('auth:sanctum');

Route::get('/singleschedulecomplete/{id}', 'AppointmentController@singleschedulecomplete')->middleware('auth:sanctum');

Route::get('/ratestatus/{invoice}', 'AppointmentController@ratestatus')->middleware('auth:sanctum');

Route::post('/rate', 'AppointmentController@rate')->middleware('auth:sanctum');

Route::get('/service_area', 'MiscController@servicearealist');

Route::get('/bloodgroups', 'MiscController@bloodgroups');

Route::post('/updateinfo', 'ProfileController@updateinfo')->middleware('auth:sanctum');

Route::post('/updateprofilepic', 'ProfileController@uploadprofilepic')->middleware('auth:sanctum');