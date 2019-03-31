<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{	
    protected $table = 'tbl_alert';

    protected $fillable = ['alert_time', 'alerts', 'device', 'trip_id'];

    public static $rules = [
    	"alert_time" => "required|date",
    	"alerts" => "required|JSON",
        "device" => "required",
        "trip_id" => "required|numeric",
	];

    public function deviceinfo()
    {
        return $this->belongsTo('App\Device', 'device', 'serial_number');
    }

    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

}