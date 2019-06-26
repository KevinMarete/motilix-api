<?php

namespace App\Http\Controllers;

use App\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::with('user')->get();
        return response()->json($notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Notification::$rules);
        $notification = Notification::create($request->all());
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        if(is_null($notification)){
            return response()->json('not_found');
        }
        return response()->json($notification);
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
        $this->validate($request, Notification::$rules);
        $notification  = Notification::find($id);
        if(is_null($notification)){
            return response()->json('not_found');
        }
        $notification->update($request->all());
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);
        if(is_null($notification)){
            return response()->json('not_found');
        }
        $notification->delete();
        return response()->json('Removed successfully.');
    }

    /**
     * Display the specified user notifications.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function getusernotification($user_id)
    {
        $notification = Notification::with('user')->where('user_id', $user_id)->get();
        return response()->json($notification);
    }

}
