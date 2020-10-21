<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'medias';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medias()
    {
        return $this->belongsToMany(Media::class);
    }

}
