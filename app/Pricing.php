<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pricing extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_pricing';

    protected $fillable = ['name', 'installation_cost', 'subscription_cost', 'total_cost', 'payment_after_months', 'features'];

    public static $rules = [
    	"name" => "required",
        "installation_cost" => "required|numeric",
        "subscription_cost" => "required|numeric",
        "total_cost" => "required|numeric",
    	"payment_after_months" => "required|numeric",
		"features" => "required|JSON"
	];

}