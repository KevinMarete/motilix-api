<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{	
	use SoftDeletes;

    protected $table = 'tbl_invoice';

    protected $fillable = ['payment_date', 'payment_id'];

    public static $rules = [
    	"payment_date" => "required|date",
    	"payment_id" => "required|numeric"
	];

	public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

}