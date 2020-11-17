<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Part of excluded Url from storing in session
     */
    protected $excludedUrl = ['otp-confirm', 'logout', 'cart', 'login', 'profile/edit', 'checkout'];

    /**
     * Display the cart.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->storeBeforeCartUrl();
        return view('frontend.cart.index', [
            'cartProducts' => Cart::getProducts(),
        ]);
    }

    /**
     * Store the before cart url in the session.
     */
    protected function storeBeforeCartUrl()
    {
        if (!Str::contains($url = URL::previous(), $this->excludedUrl) & Str::contains($url, url('/'))) {
            session(['beforeCartUrl' => $url]);
        }
    }

}
