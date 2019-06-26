<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_service';

    protected $fillable = ['maintenance_date', 'checks', 'amount', 'valuation', 'rating', 'device', 'centre_id'];

    public static $rules = [
        "maintenance_date" => "required|date",
        "checks" => "required|JSON",
        "amount" => "required|numeric",
        "valuation" => "required|numeric",
        "rating" => "required|numeric",
        "device" => "required",
        "centre_id" => "required|numeric",
        
    ];

    public function deviceinfo()
    {
        return $this->belongsTo('App\Device', 'device', 'serial_number');
    }

    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }
    
}