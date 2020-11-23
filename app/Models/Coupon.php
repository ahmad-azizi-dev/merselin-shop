<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * Retrieve and check the given coupon code.
     *
     * @param $couponCode
     * @return $this
     */
    public static function checkCode($couponCode)
    {
        return Auth::user()->coupons->where('code', $couponCode)->where('status', 1)->first();
    }
}
