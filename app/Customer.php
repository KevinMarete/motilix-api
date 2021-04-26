<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_customer';

    protected $fillable = ['user_id', 'stripe_id'];

    public static $rules = [
        "user_id" => "required|numeric",
        "stripe_id" => "required"
	];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

}