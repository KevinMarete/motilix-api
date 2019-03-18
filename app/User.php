<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;

    use HasApiTokens;

    protected $table = 'tbl_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'surname', 'phone_number', 'email', 'email_verified_at', 'password', 'remember_token', 'role_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public static $rules = [
        "firstname" => "required",
        "surname" => "required",
        "phone_number" => "required",
        "email" => "required|email|unique:tbl_user",
        "phone_number" => "required",
        "password" => "required",
        "role_id" => "required|numeric",
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }


}
