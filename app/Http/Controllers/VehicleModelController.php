<?php

namespace App\Http\Controllers;

use App\VehicleModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $vehiclemodels = VehicleModel::with('vehicle')->get();
        return response()->json($vehiclemodels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, VehicleModel::$rules);
        $vehiclemodel = VehicleModel::create($request->all());
        return response()->json($vehiclemodel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiclemodel = VehicleModel::with('vehicle')->find($id);
        if(is_null($vehiclemodel)){
            return response()->json('not_found');
        }
        return response()->json($vehiclemodel);
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
        $this->validate($request, VehicleModel::$rules);
        $vehiclemodel  = VehicleModel::find($id);
        if(is_null($vehiclemodel)){
            return response()->json('not_found');
        }
        $vehiclemodel->update($request->all());
        return response()->json($vehiclemodel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehiclemodel = VehicleModel::find($id);
        if(is_null($vehiclemodel)){
            return response()->json('not_found');
        }
        $vehiclemodel->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified vehicle models.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getvehiclemodels($id)
    {
        $vehiclemodels = VehicleModel::with('vehicle')->where('vehicle_id', $id)->get();
        return response()->json($vehiclemodels);
    }
}
