<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Refund extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_refund';

    protected $fillable = ['refund_date', 'reason_for_refund', 'payment_id', 'user_id'];

    public static $rules = [
    	"refund_date" => "required|date",
    	"reason_for_refund" => "required",
    	"payment_id" => "required|numeric",
    	"user_id" => "required|numeric"
	];

	public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}