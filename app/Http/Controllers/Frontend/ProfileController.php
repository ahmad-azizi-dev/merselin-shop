<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    protected $cartProducts;

    /**
     * Display the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->getCartProducts();
        return view('frontend.profile.show',
            array_merge($this->cartData(), ['user' => Auth::user()])
        );
    }

    /**
     * Get the cart data.
     *
     * @return array
     */
    protected function cartData()
    {
        return [
            'cartProducts'       => $this->cartProducts,
            'eagerProducts'      => Product::whereIn('id', $this->cartProducts)->get(),
            'productCountValues' => array_count_values($this->cartProducts),
        ];
    }

    /**
     * Get the cart products.
     *
     * @return void
     */
    protected function getCartProducts()
    {
        $this->cartProducts = Cart::getProducts();
    }
}
