<?php

namespace App\Http\Controllers;

use App\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alerts = Alert::with('trip.deviceinfo.brand')->get();
        return response()->json($alerts);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alert = Alert::with('trip.deviceinfo.brand')->find($id);
        if(is_null($alert)){
            return response()->json('not_found');
        }
        return response()->json($alert);
    }

    /**
     * Display the specified trip alert data.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function gettripalerts($id)
    {
        $tripalerts = Alert::with('trip.deviceinfo.brand')->where('trip_id', $id)->get();
        return response()->json($tripalerts);
    }

}