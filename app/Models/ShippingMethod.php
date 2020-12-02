<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipping-methods';

    protected $guarded = [];

    /**
     * Retrieve all of the available shipping methods.
     *
     * @return $this
     */
    public static function allShipping()
    {
        return static::where('priority', '>', 0)->orderBy('priority', 'asc')->get(['id', 'title', 'price']);
    }

    /**
     * Get the selected shipping methods.
     *
     */
    public static function selectedShippingMethod()
    {
        return static::where('id', session('selectedShippingMethod'))->firstOrFail(['title', 'price']);
    }
}
