<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

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

}
