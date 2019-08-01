<?php

namespace App\Http\Controllers;

use App\Pricing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricings = Pricing::all();
        return response()->json($pricings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Pricing::$rules);
        $pricing = Pricing::create($request->all());
        return response()->json($pricing);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pricing = Pricing::find($id);
        if(is_null($pricing)){
            return response()->json('not_found');
        }
        return response()->json($pricing);
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
        $this->validate($request, Pricing::$rules);
        $pricing  = Pricing::find($id);
        if(is_null($pricing)){
            return response()->json('not_found');
        }
        $pricing->update($request->all());
        return response()->json($pricing);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pricing = Pricing::find($id);
        if(is_null($pricing)){
            return response()->json('not_found');
        }
        $pricing->delete();
        return response()->json('Removed successfully.');
    }

}
