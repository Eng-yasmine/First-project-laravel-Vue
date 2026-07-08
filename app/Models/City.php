<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function restaurants()
    {
        return $this->hasMany(Restaurant::class);
    }
}
