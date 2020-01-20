<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_device';

    protected $fillable = ['model', 'sim_number', 'serial_number', 'is_available', 'brand_id'];

    public static $rules = [
    	"model" => "required",
    	"sim_number" => "required",
    	"serial_number" => "required",
		"is_available" => "required|boolean",
        "brand_id" => "required|numeric"
	];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}