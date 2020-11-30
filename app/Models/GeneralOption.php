<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralOption extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'general_options';

    protected $guarded = [];

    /**
     * Retrieve all of the credit card data.
     *
     * @return array
     */
    public static function allCreditCard()
    {
        return [
            'account_number'                  => static::where('key', 'account_number')->first()->value,
            'credit_card_payment_description' => static::where('key', 'credit_card_payment_description')->first()->value,
        ];
    }
}
