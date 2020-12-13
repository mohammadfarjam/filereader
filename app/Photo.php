<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
//    protected $table='photos_posts';
    protected $upload='/storage/photos/';

    public function getPathAttribute($photo)
    {
        return $this->upload.$photo;
    }

//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
}
