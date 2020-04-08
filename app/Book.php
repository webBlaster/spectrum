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
}
