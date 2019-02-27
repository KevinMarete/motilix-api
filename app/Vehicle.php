<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_vehicle';

    protected $fillable = ['name'];

    public static $rules = [
		"name" => "required"
	];

	public function models()
    {
        return $this->hasMany('App\VehicleModel');
    }
    
}
