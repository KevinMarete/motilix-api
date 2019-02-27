<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = Device::all();
        return response()->json($devices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Device::$rules);
        $device = Device::create($request->all());
        return response()->json($device);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $device = Device::find($id);
        if(is_null($device)){
            return response()->json('not_found');
        }
        return response()->json($device);
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
        $this->validate($request, Device::$rules);
        $device  = Device::find($id);
        if(is_null($device)){
            return response()->json('not_found');
        }
        $device->update($request->all());
        return response()->json($device);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        if(is_null($device)){
            return response()->json('not_found');
        }
        $device->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified brand devices.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getbranddevices($id)
    {
        $branddevices = Device::all()->where('brand_id', $id);
        return response()->json($branddevices);
    }

}
