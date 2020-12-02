<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['product_data', 'product_quantity'];

    /**
     * Get the products data.
     *
     * @return string
     */
    public function getProductDataAttribute()
    {
        return Product::whereIn('id', $this->data['preparedCartData']['cartProducts'])->get();
    }

    /**
     * Get the products quantity.
     *
     * @return string
     */
    public function getProductQuantityAttribute()
    {
        return array_count_values($this->data['preparedCartData']['cartProducts']);
    }

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
