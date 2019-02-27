<?php

namespace App\Http\Controllers;

use App\Installation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installations = Installation::all();
        return response()->json($installations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Installation::$rules);
        $installation = Installation::create($request->all());
        return response()->json($installation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $installation = Installation::find($id);
        if(is_null($installation)){
            return response()->json('not_found');
        }
        return response()->json($installation);
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
        $this->validate($request, Installation::$rules);
        $installation  = Installation::find($id);
        if(is_null($installation)){
            return response()->json('not_found');
        }
        $installation->update($request->all());
        return response()->json($installation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $installation = Installation::find($id);
        if(is_null($installation)){
            return response()->json('not_found');
        }
        $installation->delete();
        return response()->json('Removed successfully.');
    }
}
