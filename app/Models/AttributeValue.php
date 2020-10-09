<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = "attributesValue";

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class, 'attributeGroup_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'attributevalue_product', 'attributeValue_id', 'product_id');
    }
}
