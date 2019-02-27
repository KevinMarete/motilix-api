<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderLog extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_order_log';

    protected $fillable = ['status', 'order_id', 'user_id'];

    public static $rules = [
    	"status" => "required",
		"order_id" => "required|numeric",
        "user_id" => "required|numeric"
	];

	public function order()
    {
        return $this->belongsTo('App\Order');
    }

	public function user()
    {
        return $this->belongsTo('App\User');
    }

}