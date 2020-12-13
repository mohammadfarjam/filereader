<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Detail_folder extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function codeWater()
    {
        return $this->belongsTo(CodeWater::class);
    }
}
