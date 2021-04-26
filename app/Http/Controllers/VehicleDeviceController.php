<?php

namespace App\Http\Controllers;

use App\VehicleDevice;
use App\VehicleDeviceLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicledevices = VehicleDevice::with('deviceinfo','user','order')->get();
        return response()->json($vehicledevices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, VehicleDevice::$rules);
        $vehicledevice = VehicleDevice::create($request->all());
        return response()->json($vehicledevice);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicledevice = VehicleDevice::with('deviceinfo', 'user', 'order')->find($id);
        if(is_null($vehicledevice)){
            return response()->json('not_found');
        }
        return response()->json($vehicledevice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, VehicleDevice::$rules);
        $vehicledevice  = VehicleDevice::find($id);
        if(is_null($vehicledevice)){
            return response()->json('not_found');
        }
        $vehicledevice->update($request->all());
        return response()->json($vehicledevice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicledevice = VehicleDevice::find($id);
        if(is_null($vehicledevice)){
            return response()->json('not_found');
        }
        $vehicledevice->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified user devices.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getuserdevices($id)
    {
        $userdevices = VehicleDevice::with('deviceinfo', 'user', 'order')->where('user_id', $id)->get();
        return response()->json($userdevices);
    }

    /**
     * Activate ordered device.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function activatedevice(Request $request)
    {   
        $vehicledevice = VehicleDevice::with('deviceinfo', 'user', 'order')->where(array('order_id' => $request->order_id, 'user_id' => $request->user_id))->first();
        if ($vehicledevice && $vehicledevice['status'] != 'active') {
			$seedstr='motilix';
            $code = strtoupper(substr(md5($vehicledevice['device'].$seedstr), 0, 6));
			if($code == $request->code){
				if(empty($vehicledevice->device_activated_at)){
                    $vehicledevice->status = 'active';
	        		$vehicledevice->device_activated_at = date('Y-m-d H:i:s');
	        		$vehicledevice->save();
                }
                //Create vehicle device log
                $vehicledevicelog = VehicleDeviceLog::create([
                    'status' => 'active',
                    'vehicle_device_id' => $vehicledevice->id,
                    'user_id' => $request->user_id
                ]);
				return response(['msg'=> 'Vehicle Device activated!'], 200);
			}else{
				$response = 'Vehicle Device was not activated!';
	        	return response(['error' => $response], 401);
			}
        } 
        else if ($vehicledevice['status'] == 'active'){
            $response = 'Vehicle Device is already activated!';
	        return response(['error' => $response], 401);
        }
        else {
			$response = 'Vehicle Device does not exist!';
	        return response(['error' => $response], 401);
	    }
    }

}
