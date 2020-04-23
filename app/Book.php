<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use softDeletes;
    //
    protected $fillable = ['title', 'author', 'path', 'front_cover'];
    
    public function book_count() {
        return $this->all()->count();
    }

    public function access_codes() {
        return $this->belongsToMany(AccessCode::class, 'book_access_code', 'access_code_uuid', 'book_id', 'uuid')->withPivot('created_at', '');
    }
}
