<?php

namespace App;

use BinaryCabin\LaravelUUID\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessCode extends Model
{
    use HasUUID, SoftDeletes;
    protected $fillable = ['code', 'expires', 'license_name', 'books_contained', 'price', 'max_number_of_users', 'duration', 'group_id'];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function books() {
        return $this->belongsToMany('App\Book', 'book_access_code', 'access_code_uuid', 'book_id', 'uuid', 'id')
        ->withTrashed()
        ->where(function ($query) {
            $query->whereNull('deleted_at')->orWhere('deleted_at', '<>', '');
        });
    }
}
