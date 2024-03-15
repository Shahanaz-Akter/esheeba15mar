<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['cors'])->group(function () {

    Route::get('/', function () {
        return view('website.index');
    });

    Route::get('/en', function () {
        return view('website.en');
    });

    Route::get('/bn', function () {
        return view('website.bn');
    });
});

Route::get('/newpage', function () {
    return view('website.newpage');
});



Route::get('/login', 'AdminController@loginpage');

Route::post('/login', 'AdminController@login');

Route::get('/privacy', function () {
    return view('website.privacy');
});


Route::middleware(['webauth'])->group(function () {

    Route::get('/dashboard', 'AdminController@dashboard');

    Route::get('/logout', 'AdminController@logout');

    Route::get('/appointments', 'AdminController@appointments');

    Route::get('/appointment/{id}', 'AdminController@appointmentdetails');

    Route::get('/unassigned', 'AdminController@unassigned');

    Route::get('/assign_nurse/{invoice}/{nurse}', 'AdminController@assign_nurse');

    Route::get('/togglepayment/{invoice}/{paid}', 'AdminController@togglepayment');

    Route::get('/updatestatus/{invoice}/{status}', 'AdminController@updatestatus');

    Route::get('/invoices', 'AdminController@invoices');

    Route::get('/nurses', 'AdminController@nurses');

    Route::get('/nurse/{id}', 'AdminController@nursedetails');
    Route::post('/updatepic/{usertype}/{id}', 'AdminController@updatepic');

    Route::post('/updatenurse/{id}', 'AdminController@updatenurse');
    Route::get('/deletenurse/{id}', 'AdminController@deletenurse');


    Route::get('/clients', 'AdminController@clients');

    Route::get('/client/{id}', 'AdminController@clientdetails');

    Route::post('/updateclient/{id}', 'AdminController@updateclient');
    Route::get('/delete_client/{id}', 'AdminController@deleteclient');
    Route::post('/custom_adding_clients', 'AdminController@custom_adding_clients');



    Route::middleware(['superadmin'])->group(function () {

        Route::get('/admins', 'AdminController@admins');

        Route::post('/admin_add', 'AdminController@admin_add');

        Route::get('/toggle_admin/{id}', 'AdminController@toggleadmin');

        Route::get('/resetadminpassword/{id}', 'AdminController@resetadminpassword');

        Route::get('/deleteadmin/{id}', 'AdminController@deleteadmin');
    });

    Route::get('/referrals', 'AdminController@referrals');

    Route::post('/add_referral', 'AdminController@add_referral');

    Route::post('/update_discount/{id}', 'AdminController@update_discount');

    Route::post('/set_validity/{id}', 'AdminController@set_validity');

    Route::get('/ads', 'AdminController@ads');

    Route::post('/new_ads', 'AdminController@new_ads');

    Route::get('/servicecategories', 'AdminController@servicecategories');

    Route::post('/add_servicecategories', 'AdminController@add_servicecategories');

    Route::get('/servicelist', 'AdminController@servicelist');

    Route::post('/add_service', 'AdminController@add_service');

    Route::get('/serviceareas', 'AdminController@serviceareas');

    Route::post('/add_servicearea', 'AdminController@add_servicearea');
});
