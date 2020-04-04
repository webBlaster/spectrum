<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlacklistedImei extends Model
{
    //
    protected $fillable = [
        'user_id', 'imei'
    ];
    
}
