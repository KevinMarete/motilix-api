<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_brand';

    protected $fillable = ['name'];

    public static $rules = [
		"name" => "required"
	];

	public function devices()
    {
        return $this->hasMany('App\Device');
    }

}