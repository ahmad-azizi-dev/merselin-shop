<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
