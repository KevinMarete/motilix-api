<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_card';

    protected $fillable = ['name_on_card', 'card_number', 'expiry_period', 'subscription_date', 'user_id'];

    protected $hidden = []; //gateway_token

    public static $rules = [
    	"name_on_card" => "required",
    	"card_number" => "required",
    	"expiry_period" => "required",
    	"subscription_date" => "required|date",
        "user_id" => "required|numeric"
	];

	public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function card()
    {
        return $this->hasOne('App\Card');
    }

}