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

Route::group(['middleware' => ['json.response'],'prefix' => 'v1'], function () {
	//Public endpoints
	Route::get('/unauthorized', 'Auth\AuthController@unauthorized')->name('unauthorized');
	Route::post('/register', 'Auth\AuthController@register')->name('register');
	Route::post('/activate', 'Auth\AuthController@activate')->name('activate');
	Route::post('/login', 'Auth\AuthController@login')->name('login');
	Route::post('/activateaccountemail', 'Auth\AuthController@activateaccountemail')->name('activateaccountemail');
	Route::post('/forgotpasswordemail', 'Auth\AuthController@forgotpasswordemail')->name('forgotpasswordemail');
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
		Route::resource('/user', 'UserController');
        Route::resource('/role', 'RoleController');
        Route::resource('/vehicle', 'VehicleController');
		Route::get('/vehicle/{id}/models', 'VehicleModelController@getvehiclemodels');
		Route::get('/vehiclemodel/{id}/orders', 'OrderController@getordermodels');
		Route::resource('/vehiclemodel', 'VehicleModelController');
		Route::resource('/brand', 'BrandController');
		Route::get('/brand/{id}/devices', 'DeviceController@getbranddevices');
		Route::resource('/device', 'DeviceController');
		Route::resource('/order', 'OrderController');
		Route::get('/order/{id}/logs', 'OrderLogController@getorderlogs');
		Route::get('/order/{id}/logs/{user_id}/user', 'OrderLogController@getorderloguser');
		Route::resource('/orderlog', 'OrderLogController');
		Route::resource('/card', 'CardController');
		Route::get('/device/{id}/payments', 'PaymentController@getdevicepayments');
		Route::get('/card/{id}/payments', 'PaymentController@getcardpayments');
		Route::resource('/payment', 'PaymentController');
		Route::resource('/installation', 'InstallationController');
		Route::resource('/subscription', 'SubscriptionController');
		Route::resource('/invoice', 'InvoiceController');
		Route::get('/refund/{id}/payments', 'RefundController@getrefundpayments');
		Route::resource('/refund', 'RefundController');
		Route::resource('/vehicledevice', 'VehicleDeviceController');
		Route::post('/devicetrips', 'TripController@getdevicetrips')->name('devicetrips');
		Route::resource('/trip', 'TripController');
		Route::get('/trip/{id}/health', 'HealthController@gettriphealth');
		Route::resource('/health', 'HealthController');
		Route::get('/trip/{id}/alerts', 'AlertController@gettripalerts');
		Route::resource('/alert', 'AlertController');
    });
});