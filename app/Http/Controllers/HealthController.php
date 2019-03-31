<?php

namespace App\Http\Controllers;

use App\Health;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HealthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $healths = Health::with('trip.deviceinfo.brand')->get();
        return response()->json($healths);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $health = Health::with('trip.deviceinfo.brand')->find($id);
        if(is_null($health)){
            return response()->json('not_found');
        }
        return response()->json($health);
    }

    /**
     * Display the specified trip health data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gettriphealth($id)
    {
        $tripheath = Health::with('trip.deviceinfo.brand')->where('trip_id', $id)->get();
        return response()->json($tripheath);
    }

}