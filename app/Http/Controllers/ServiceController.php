<?php

namespace App\Http\Controllers;

use App\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::with('deviceinfo.centre')->get();
        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Service::$rules);
        $service = Service::create($request->all());
        return response()->json($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::find($id);
        if(is_null($service)){
            return response()->json('not_found');
        }
        return response()->json($service);
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
        $this->validate($request, Service::$rules);
        $service  = Service::find($id);
        if(is_null($service)){
            return response()->json('not_found');
        }
        $service->update($request->all());
        return response()->json($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if(is_null($service)){
            return response()->json('not_found');
        }
        $service->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified device service history.
     *
     * @param  string  $device
     * @return \Illuminate\Http\Response
     */
    public function getservicehistory($device)
    {
        $deviceservices = Service::with('deviceinfo.centre')->where('device', $device)->get();
        return response()->json($deviceservices);
    }

}
