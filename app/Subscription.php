<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_subscription';

    protected $fillable = ['membership_fee', 'start_date', 'end_date', 'payment_id'];

    public static $rules = [
    	"membership_fee" => "required|numeric",
    	"start_date" => "required|date",
    	"end_date" => "required|date",
    	"payment_id" => "required|numeric"
	];

	public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

}