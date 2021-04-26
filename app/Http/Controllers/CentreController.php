<?php

namespace App\Http\Controllers;

use App\Centre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CentreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centres = Centre::all();
        return response()->json($centres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Centre::$rules);
        $centre = Centre::create($request->all());
        return response()->json($centre);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $centre = Centre::find($id);
        if(is_null($centre)){
            return response()->json('not_found');
        }
        return response()->json($centre);
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
        $this->validate($request, Centre::$rules);
        $centre  = Centre::find($id);
        if(is_null($centre)){
            return response()->json('not_found');
        }
        $centre->update($request->all());
        return response()->json($centre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $centre = Centre::find($id);
        if(is_null($centre)){
            return response()->json('not_found');
        }
        $centre->delete();
        return response()->json('Removed successfully.');
    }
}
