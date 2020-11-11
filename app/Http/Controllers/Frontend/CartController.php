<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CartController extends Controller
{
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
        if (!Str::contains($url = URL::previous(), ['otp-confirm', 'logout', 'cart', 'login']) & Str::contains($url, url('/'))) {
            session(['beforeCartUrl' => $url]);
        }
    }

}
