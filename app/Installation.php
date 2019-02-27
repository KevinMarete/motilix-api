<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installation extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_installation';

    protected $fillable = ['initial_fee', 'payment_id'];

    public static $rules = [
    	"initial_fee" => "required|numeric",
    	"payment_id" => "required|numeric",
        "order_id" => "required|numeric"
	];

	public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}