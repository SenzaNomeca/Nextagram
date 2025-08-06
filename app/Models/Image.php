<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $table = 'image';

    // Relacion One To Many
    public function comments(){
        return $this->hasMany('App\Models\Comment')->OrderBy('id','DESC');
    }

    // One to many Likes
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    // User: Many to one
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
