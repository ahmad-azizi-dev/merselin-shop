<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginByPhoneToken extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'token', 'status'];

    /**
     * Generate a new token for the given phone number.
     *
     * @param User $user
     * @return $this
     */
    public static function generateFor($phoneNumber)
    {
        return static::create([
            'phone_number' => $phoneNumber,
            'token'        => mt_rand(10000, 99999),
            'status'       => 'not been sent yet',
        ]);
    }

    /**
     * Get the route key for implicit model binding.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'phone_number';
    }

    /**
     * Send the token to the user.
     */
    public function send()
    {
        //
    }
}
