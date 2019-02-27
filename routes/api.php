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
Route::get('/order/{id}/logs/{id}/user', 'OrderLogController@getorderloguser');
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

/*Route::group(['middleware' => ['api'],'prefix' => 'v1/role'],function (){
    Route::post('create','RoleController@create')->name('role.create');
    Route::get('all','RoleController@all')->name('role.all');
    Route::post('update/{role}','RoleController@update')->name('role.update');
    Route::get('show/{role}','RoleController@show')->name('role.show');
    Route::post('delete/{role}','RoleController@delete')->name('role.delete');
});*/
