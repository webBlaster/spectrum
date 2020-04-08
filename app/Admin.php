<?php

namespace App;

use Auth;
use Carbon\Carbon;
use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable

{
    use Notifiable, HasUUID, SoftDeletes;
    // protected $primaryKey = 'uuid';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'uuid',
    ];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUsernameAttribute($username) {
        return $this->username = ucfirst($username);
    }
    public function getNameAttribute($name) {
        return $this->name = ucwords($name);
    }

    public function fetch_activated_user() {
        $exclude_active_user = Auth::guard('admin')->user()->uuid;
        return $this->where('status', 1)->where('uuid', '<>', $exclude_active_user)->get();
    }
    public function fetch_unactivated_user() {
        $exclude_active_user = Auth::guard('admin')->user()->uuid;
        return $this->where('status', 0)->where('uuid', '<>', $exclude_active_user)->get();
    }

    public function getCreatedAtAttribute($date) {
        return Carbon::parse(strtotime($date))->diffForHumans();
    }
}
