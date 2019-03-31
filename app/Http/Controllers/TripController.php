<?php

namespace App\Http\Controllers;

use App\Trip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = Trip::with('deviceinfo.brand')->get();
        return response()->json($trips);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::with('deviceinfo.brand')->find($id);
        if(is_null($trip)){
            return response()->json('not_found');
        }
        return response()->json($trip);
    }

    /**
     * Display the specified device trips.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getdevicetrips(Request $request)
    {
        $devicetrips = Trip::with('deviceinfo.brand')->where('device', $request->device)->get();
        return response()->json($devicetrips);
    }
    
}