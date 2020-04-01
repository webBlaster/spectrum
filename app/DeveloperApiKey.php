<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class DeveloperApiKey extends Model
{
    //
    use HasUUID;
    protected $fillable = ['key'];
    protected $uuidFieldName = 'duid';
}
