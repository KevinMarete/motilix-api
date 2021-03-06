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

Route::group(['middleware' => ['json.response', 'cors'],'prefix' => 'v1'], function () {
	//Public endpoints
	Route::get('/unauthorized', 'Auth\AuthController@unauthorized')->name('unauthorized');
	Route::post('/register', 'Auth\AuthController@register')->name('register');
	Route::post('/activate', 'Auth\AuthController@activate')->name('activate');
	Route::post('/login', 'Auth\AuthController@login')->name('login');
	Route::post('/get-token', 'Auth\AuthController@login')->name('get-token');
	Route::post('/activateaccountemail', 'Auth\AuthController@activateaccountemail')->name('activateaccountemail');
	Route::post('/forgotpasswordemail', 'Auth\AuthController@forgotpasswordemail')->name('forgotpasswordemail');
	Route::post('/reset-secret', 'Auth\AuthController@forgotpasswordemail')->name('reset-secret');
	Route::post('/resetpassword', 'Auth\AuthController@resetpassword')->name('resetpassword');
	Route::get('/activateaccountcode', 'Auth\AuthController@activateaccountcode')->name('activateaccountcode');
	Route::post('/verifyaccountcode', 'Auth\AuthController@verifyaccountcode')->name('verifyaccountcode');
	//Private endpoints
	Route::middleware('auth:api')->group(function () {
		Route::post('/logout', 'Auth\AuthController@logout')->name('logout');
		Route::post('/changepassword', 'Auth\AuthController@changepassword')->name('changepassword');
		Route::get('/profile', 'Auth\AuthController@viewprofile')->name('profile');
		Route::put('/profile', 'Auth\AuthController@updateprofile')->name('profile');
		Route::get('/user/{id}/orders', 'OrderController@getuserorders');
		Route::get('/user/{id}/cards', 'CardController@getusercards');
		Route::get('/user/{id}/devices', 'VehicleDeviceController@getuserdevices');
		Route::get('/user/{id}/notification', 'NotificationController@getusernotification');
		Route::resource('/user', 'UserController');
        Route::resource('/role', 'RoleController');
        Route::resource('/vehicle', 'VehicleController');
		Route::get('/vehicle/{id}/models', 'VehicleModelController@getvehiclemodels');
		Route::get('/vehiclemodel/{id}/orders', 'OrderController@getordermodels');
		Route::resource('/vehiclemodel', 'VehicleModelController');
		Route::resource('/brand', 'BrandController');
		Route::get('/brand/{id}/devices', 'DeviceController@getbranddevices');
		Route::resource('/device', 'DeviceController');
		Route::post('/checkout', 'OrderController@checkoutorder');
		Route::resource('/order', 'OrderController');
		Route::get('/order/{id}/logs', 'OrderLogController@getorderlogs');
		Route::get('/order/{id}/logs/{user_id}/user', 'OrderLogController@getorderloguser');
		Route::resource('/orderlog', 'OrderLogController');
		Route::resource('/card', 'CardController');
		Route::get('/device/{device}/payments', 'PaymentController@getdevicepayments');
		Route::get('/card/{id}/payments', 'PaymentController@getcardpayments');
		Route::resource('/payment', 'PaymentController');
		Route::resource('/installation', 'InstallationController');
		Route::resource('/subscription', 'SubscriptionController');
		Route::resource('/invoice', 'InvoiceController');
		Route::get('/refund/{id}/payments', 'RefundController@getrefundpayments');
		Route::resource('/refund', 'RefundController');
		Route::post('/activatedevice', 'VehicleDeviceController@activatedevice')->name('activatedevice');
		Route::resource('/vehicledevice', 'VehicleDeviceController');
		Route::get('/vehicledevice/{id}/logs', 'VehicleDeviceLogController@getvehicledevicelogs');
		Route::get('/vehicledevice/{id}/logs/{user_id}/user', 'VehicleDeviceLogController@getvehicledeviceloguser');
		Route::resource('/vehicledevicelog', 'VehicleDeviceLogController');
		Route::post('/devicetrips', 'TripController@getdevicetrips')->name('devicetrips');
		Route::resource('/trip', 'TripController');
		Route::get('/healthstatus/{device}', 'HealthController@gethealthstatus');
		Route::get('/trip/{id}/health', 'HealthController@gettriphealth');
		Route::resource('/health', 'HealthController');
		Route::get('/trip/{id}/alerts', 'AlertController@gettripalerts');
		Route::resource('/alert', 'AlertController');
		Route::resource('/centre', 'CentreController');
		Route::get('/servicehistory/{device}', 'ServiceController@getservicehistory')->name('servicehistory');
		Route::resource('/service', 'ServiceController');
		Route::resource('/notification', 'NotificationController');
		Route::resource('/pricing', 'PricingController');
    });
});