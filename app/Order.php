<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_order';

    protected $fillable = ['year_of_manufacture', 'number_plate', 'location', 'location_details', 'preferred_delivery_date', 'preferred_delivery_time', 'other_details', 'status', 'user_id', 'vehicle_model_id'];

    public static $rules = [
    	"year_of_manufacture" => "required|date",
    	"number_plate" => "required",
        "location" => "required",
        "location_details" => "required",
        "preferred_delivery_date" => "required|date",
        "preferred_delivery_time" => "required",
        "other_details" => "required",
    	"status" => "required",
		"user_id" => "required|numeric",
        "vehicle_model_id" => "required|numeric"
	];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vehiclemodel()
    {
        return $this->belongsTo('App\VehicleModel');
    }

    public function logs()
    {
        return $this->hasMany('App\OrderLog');
    }

    public function installation()
    {
        return $this->hasOne('App\Installation');
    }

}