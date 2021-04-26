<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Centre extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_centre';

    protected $fillable = ['name', 'location', 'location_details'];

    public static $rules = [
        "name" => "required",
        "location" => "required",
        "location_details" => "required"
    ];
    
}