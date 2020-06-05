<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'phone', 'imei', 'password', 'login_attempt', 'access_code', 'uuid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function blackListedImei() {
        return $this->hasOne('App\BlacklistedImei');
    }

    public function users_count() {
        return $this->all()->count();
    }

    public function count_users_with_license() {
        return $this->where('access_code', '<>', '')->count();
    }
}
