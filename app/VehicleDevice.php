<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleDevice extends Model
{
    //
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleDevice extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_vehicle_device';

    protected $fillable = ['device_id', 'user_id', 'order_id'];

    public static $rules = [
    	"device_id" => "required|numeric",
    	"user_id" => "required|numeric",
        "order_id" => "required|numeric"
	];

	public function device()
    {
        return $this->belongsTo('App\Device');
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