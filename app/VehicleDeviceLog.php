<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleDeviceLog extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_vehicle_device_log';

    protected $fillable = ['status', 'vehicle_device_id', 'user_id'];

    public static $rules = [
    	"status" => "required",
		"vehicle_device_id" => "required|numeric",
        "user_id" => "required|numeric"
	];

	public function vehicledevice()
    {
        return $this->belongsTo('App\VehicleDevice');
    }

	public function user()
    {
        return $this->belongsTo('App\User');
    }

}