<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // 
    protected $fillable = ['biography', 'address'];

    public function user()
    {
        return $this->blongsTo(\App\User::class);
    }
}
