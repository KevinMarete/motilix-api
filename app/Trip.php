<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{	
    protected $table = 'tbl_trip';

    protected $fillable = ['start_time', 'start_location', 'start_mileage', 'start_fuel_level', 'end_time', 'end_location', 'end_mileage', 'end_fuel_level', 'duration', 'distance', 'fuel_consumption', 'positions', 'device'];

    public static $rules = [
    	"start_time" => "required|date",
    	"start_location" => "required",
    	"start_mileage" => "required|numeric",
        "start_fuel_level" => "required|numeric",
        "end_time" => "required|date",
    	"end_location" => "required",
    	"end_mileage" => "required|numeric",
        "end_fuel_level" => "required|numeric",
        "duration" => "required",
    	"distance" => "required|numeric",
    	"fuel_consumption" => "required|numeric",
		"positions" => "required|JSON",
        "device" => "required"
	];

    public function deviceinfo()
    {
        return $this->belongsTo('App\Device', 'device', 'serial_number');
    }
    
}