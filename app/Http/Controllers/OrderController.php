<?php

namespace App\Http\Controllers;

use App\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('user','vehiclemodel')->get();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Order::$rules);
        $order = Order::create($request->all());
        return response()->json($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('user.vehicle_model')->find($id);
        if(is_null($order)){
            return response()->json('not_found');
        }
        return response()->json($order);
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
        $this->validate($request, Order::$rules);
        $order  = Order::find($id);
        if(is_null($order)){
            return response()->json('not_found');
        }
        $order->update($request->all());
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if(is_null($order)){
            return response()->json('not_found');
        }
        $order->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified order logs.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getordermodels($id)
    {
        $ordermodels = Order::with('user.vehicle_model')->where('vehicle_model_id', $id)->get();
        return response()->json($ordermodels);
    }

    /**
     * Display the specified user orders.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getuserorders($id)
    {
        $userorders = Order::with('user.vehicle_model')->where('user_id', $id)->get();
        return response()->json($userorders);
    }
    
}
