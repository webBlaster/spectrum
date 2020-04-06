<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'notification', 'created_by'];

    public function creator() {
        return $this->belongsTo(Admin::class, 'created_by', 'uuid');
    }
}
