<?php

namespace App\Http\Controllers;

use App\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return response()->json($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Vehicle::$rules);
        $vehicle = Vehicle::create($request->all());
        return response()->json($vehicle);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        if(is_null($vehicle)){
            return response()->json('not_found');
        }
        return response()->json($vehicle);
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
        $this->validate($request, Vehicle::$rules);
        $vehicle  = Vehicle::find($id);
        if(is_null($vehicle)){
            return response()->json('not_found');
        }
        $vehicle->update($request->all());
        return response()->json($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        if(is_null($vehicle)){
            return response()->json('not_found');
        }
        $vehicle->delete();
        return response()->json('Removed successfully.');
    }
}
