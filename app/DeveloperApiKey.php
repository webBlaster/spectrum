<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeveloperApiKey extends Model
{
    //
    use HasUUID, SoftDeletes;
    protected $fillable = ['key', 'duid', 'duration', 'created_by', 'valid_from', 'valid_till'];
    protected $uuidFieldName = 'duid';
    protected $dates = ['valid_from', 'valid_till'];



    public function creator() {
        return $this->belongsTo('App\Admin', 'created_by', 'uuid');
    }
}
