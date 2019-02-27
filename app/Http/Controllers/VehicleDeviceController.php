<?php

namespace App\Http\Controllers;

use App\VehicleDevice;
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
        $vehicledevices = VehicleDevice::all();
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
        $vehicledevice = VehicleDevice::find($id);
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
}
