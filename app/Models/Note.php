<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';

    public function category_(){
        return $this->belongsTo('App\Models\Category', 'category', 'id');
    }

    public function author_(){
        return $this->belongsTo('App\Models\User', 'author', 'id');
    }
}
