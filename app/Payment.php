<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_payment';

    protected $fillable = ['discount_amount', 'card_id', 'device', 'pricing_id'];

    public static $rules = [
        "discount_amount" => "required|numeric",
    	"card_id" => "required|numeric",
        "device" => "required",
        "pricing_id" => "required|numeric"
	];

	public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function deviceinfo()
    {
        return $this->belongsTo('App\Device', 'device', 'serial_number');
    }

    public function pricing()
    {
        return $this->belongsTo('App\Pricing');
    }

    public function installation()
    {
        return $this->hasOne('App\Installation');
    }

    public function subscription()
    {
        return $this->hasOne('App\Subscription');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice');
    }

    public function refund()
    {
        return $this->hasOne('App\Refund');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}