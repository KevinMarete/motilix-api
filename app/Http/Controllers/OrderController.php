<?php

namespace App\Http\Controllers;

use App\Card;
use App\Customer;
use App\Device;
use App\Installation;
use App\Invoice;
use App\Order;
use App\OrderLog;
use App\Payment;
use App\Pricing;
use App\Subscription;
use App\VehicleDevice;
use App\VehicleDeviceLog;
use Cartalyst\Stripe\Stripe;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivateDeviceEmail;

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
        //Create New Order
        $this->validate($request, Order::$rules);
        $order = Order::create($request->all());

        //Check if user has stripe_id
        $customer = Customer::with('user')->where('user_id', $request->user_id)->get();
        if($customer->isEmpty()){
            //Create new customer on stripe
            $stripe = new Stripe(env('STRIPE_SECRET'));
            $customer = $stripe->customers()->create([
                'name' => $order->user->firstname." ". $order->user->surname,
                'email' => $order->user->email,
                'phone' => $order->user->phone_number
            ]);
            //Save stripe_id 
            $customer = new Request(['user_id' => $order->user_id, 'stripe_id' => $customer['id']]);
            $this->validate($customer, Customer::$rules);
            $customer = Customer::create($customer->all());
        }

        //Add order_log for new order
        $order_log = OrderLog::create([
            'status' => $order->status,
            'order_id' => $order->id,
            'user_id' => $order->user->id
        ]);

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

        //Add order_log for updated order
        $order_log = OrderLog::create([
            'status' => $order->status,
            'order_id' => $order->id,
            'user_id' => $order->user->id
        ]);

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

    /**
     * Checkout a new order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkoutorder(Request $request)
    {
        //Get available device from device list
        $device = Device::with('brand')->where('is_available', 't')->orderBy('created_at', 'asc')->first();

        if($device){
            try{
                DB::beginTransaction();
                //Check if user is linked to card and order
                $card_user = Card::with('user')->where('id', $request->card_id)->where('user_id', $request->user_id)->first();
                $order_user = Order::with('user')->where('id', $request->order_id)->where('user_id', $request->user_id)->first();
                $device_user = VehicleDevice::with('deviceinfo','user','order')->where('device', $device->serial_number)->where('user_id', $request->user_id)->where('order_id', $request->order_id)->first();

                if(!$card_user){
                    return response(['error' => 'Card does not belong to user!'], 401);
                }

                if(!$order_user){
                    return response(['error' => 'Order does not belong to user!'], 401);
                }
   
                if($order_user['status'] != 'pending'){
                    return response(['error' => 'Order has already been paid!'], 401);
                }

                if($device_user){
                    return response(['error' => 'Order Device has already been assigned!'], 401);
                }
                
                //Get pricing info
                $pricing = Pricing::find($request->pricing_id);
                if($pricing){
                    //Make parent payment
                    $payment = Payment::create([
                        'card_id' => $request->card_id,
                        'device' => $device->serial_number,
                        'pricing_id' => $request->pricing_id
                    ]);

                    //Make installation payment
                    $installation = Installation::create([
                        'initial_fee' => $pricing->installation_cost,
                        'payment_id' => $payment->id,
                        'order_id' => $request->order_id
                    ]);

                    //Make subscription payment
                    $subscription = Subscription::create([
                        'membership_fee' => $pricing->subscription_cost,
                        'start_date' => date('Y-m-d'),
                        'end_date' => date('Y-m-d',  strtotime('+'.strval($pricing->payment_after_months).' months')),
                        'payment_id' => $payment->id
                    ]);

                    //Create Invoice
                    $invoice = Invoice::create([
                        'payment_date' => date('Y-m-d'),
                        'payment_id' => $payment->id
                    ]);

                    //Create vehicle device 
                    $vehicledevice = VehicleDevice::create([
                        'device' => $device->serial_number,
                        'status' => 'inactive',
                        'user_id' => $request->user_id,
                        'order_id' => $request->order_id
                    ]);

                    //Create vehicle device log
                    $vehicledevicelog = VehicleDeviceLog::create([
                        'status' => 'inactive',
                        'vehicle_device_id' => $vehicledevice->id,
                        'user_id' => $request->user_id
                    ]);

                    //Update Order Status
                    $order = Order::with('user')->find($request->order_id);
                    $order->update(['status' => 'paid']);

                    //Add order_log for updated order
                    $order_log = OrderLog::create([
                        'status' => $order->status,
                        'order_id' => $order->id,
                        'user_id' => $order->user->id
                    ]);

                    //Update device to not-available
                    $device->is_available = false;
                    $device->save();
                    
                    //Send activate device code to user email
                    $seedstr='motilix';
                    $order->code = strtoupper(substr(md5($device->serial_number.$seedstr), 0, 6));
                    $order->device = $device->serial_number;
			        Mail::send(new ActivateDeviceEmail($order));

                    DB::commit();

                    return response(['msg' => 'Order payment successful, awaiting delivery!'], 200);
                }

                return response(['error' => 'Pricing information does not exist!'], 401);

            } catch(\Exception $e){
                DB::rollback();
                echo $e->getMessage();
            }	
        }else{
            return response(['error' => 'No available devices to fulfill your order!'], 401);
        }

    }
    
}
