<?php

namespace App\Http\Controllers;

use App\OrderLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderlogs = OrderLog::with('order.user')->get();
        return response()->json($orderlogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, OrderLog::$rules);
        $orderlog = OrderLog::create($request->all());
        return response()->json($orderlog);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderlog = OrderLog::with('order.user')->find($id);
        if(is_null($orderlog)){
            return response()->json('not_found');
        }
        return response()->json($orderlog);
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
        $this->validate($request, OrderLog::$rules);
        $orderlog  = OrderLog::find($id);
        if(is_null($orderlog)){
            return response()->json('not_found');
        }
        $orderlog->update($request->all());
        return response()->json($orderlog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderlog = OrderLog::find($id);
        if(is_null($orderlog)){
            return response()->json('not_found');
        }
        $orderlog->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified order logs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getorderlogs($id)
    {
        $orderlogs = OrderLog::with('order.user')->where('order_id', $id)->get();
        return response()->json($orderlogs);
    }

    /**
     * Display the specified user order logs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getorderloguser($id, $user_id)
    {   
        $orderlogs = OrderLog::with('order.user')->where(array('order_id' => $id, 'user_id' => $user_id))->get();
        return response()->json($orderlogs);
    }
}
