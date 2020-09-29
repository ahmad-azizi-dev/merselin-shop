<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table = "attributesgroup";

    public function attributesValue()
    {
        return $this->hasMany(AttributeValue::class, 'attributeGroup_id');
    }

}
