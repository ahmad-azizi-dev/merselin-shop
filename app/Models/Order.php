<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Check to be unique the order code.
     *
     * @param $code
     * @return boolean
     */
    public static function checkOrderCode($code)
    {
        return static::where('code', $code)->exists();
    }
}
