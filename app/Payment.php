<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_payment';

    protected $fillable = ['card_id', 'device_id'];

    public static $rules = [
    	"card_id" => "required|numeric",
        "device_id" => "required|numeric"
	];

	public function card()
    {
        return $this->belongsTo('App\Card');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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

}