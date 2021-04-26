<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_notification';

    protected $fillable = ['notifications', 'user_id'];

    public static $rules = [
        "notifications" => "required|JSON",
        "user_id" => "required|numeric"
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}