<?php

namespace App\Http\Controllers;

use App\VehicleDeviceLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleDeviceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicledeviceLogs = VehicleDeviceLog::with('vehicledevice.user')->get();
        return response()->json($vehicledeviceLogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, VehicleDeviceLog::$rules);
        $vehicledeviceLog = VehicleDeviceLog::create($request->all());
        return response()->json($vehicledeviceLog);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicledeviceLog = VehicleDeviceLog::with('vehicledevice.user')->find($id);
        if(is_null($vehicledeviceLog)){
            return response()->json('not_found');
        }
        return response()->json($vehicledeviceLog);
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
        $this->validate($request, VehicleDeviceLog::$rules);
        $vehicledeviceLog  = VehicleDeviceLog::find($id);
        if(is_null($vehicledeviceLog)){
            return response()->json('not_found');
        }
        $vehicledeviceLog->update($request->all());
        return response()->json($vehicledeviceLog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicledeviceLog = VehicleDeviceLog::find($id);
        if(is_null($vehicledeviceLog)){
            return response()->json('not_found');
        }
        $vehicledeviceLog->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified vehicle device logs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getvehicledevicelogs($id)
    {
        $vehicledeviceLogs = VehicleDeviceLog::with('vehicledevice.user')->where('vehicle_device_id', $id)->get();
        return response()->json($vehicledeviceLogs);
    }

    /**
     * Display the specified user vehicle device logs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getvehicledeviceloguser($id, $user_id)
    {   
        $vehicledeviceLogs = VehicleDeviceLog::with('vehicledevice.user')->where(array('vehicle_device_id' => $id, 'user_id' => $user_id))->get();
        return response()->json($vehicledeviceLogs);
    }
}
