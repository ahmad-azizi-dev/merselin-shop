<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function getPriceAttribute($price)
    {
        $price = round($price);
        return "$price";
    }

    public function getDiscountPriceAttribute($discount_price)
    {
        $discount_price = round($discount_price);
        return "$discount_price";
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'attributevalue_product', 'product_id', 'attributeValue_id');
    }

    public function medias()
    {
        return $this->belongsToMany(Media::class, 'madia_product', 'product_id', 'media_id');
    }

    public function getDiscountedPricePercentage()
    {
        return round((($this->price - $this->discount_price) * 100) / $this->price);
    }
}
