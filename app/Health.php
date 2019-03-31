<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{	
    protected $table = 'tbl_health';

    protected $fillable = ['status_time', 'status', 'device', 'trip_id'];

    public static $rules = [
    	"status_time" => "required|date",
    	"status" => "required|JSON",
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