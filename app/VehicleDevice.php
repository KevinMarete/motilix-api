<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleDevice extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_vehicle_device';

    protected $fillable = ['device', 'user_id', 'order_id'];

    public static $rules = [
    	"device" => "required",
    	"user_id" => "required|numeric",
        "order_id" => "required|numeric"
	];

	public function deviceinfo()
    {
        return $this->belongsTo('App\Device', 'device', 'serial_number');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}