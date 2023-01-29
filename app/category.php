<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'category'
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }
}
