<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSupport extends Model
{
    protected $table = 'user_support';
    protected $guarded = [];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
        // return $this->hasOne(User::class, 'email', 'email');
    }
}
