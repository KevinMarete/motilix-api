<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_vehicle_model';

    protected $fillable = ['name', 'manufacture_year', 'is_supported', 'vehicle_id'];

    public static $rules = [
        "name" => "required",
        "manufacture_year" => "required|numeric",
		"is_supported" => "required|boolean",
        "vehicle_id" => "required|numeric"
	];

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}