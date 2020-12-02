<?php

namespace App\Http\Controllers\Frontend\Traits;

use App\Facades\Cart;
use App\Models\Product;

trait RetrieveCartData
{
    /**
     * Get the cart products ID.
     *
     * @return void
     */
    protected function getCartProducts()
    {
        $this->cartProducts = Cart::getProducts();
    }

    /**
     * Get the cart data.
     *
     * @return array
     */
    protected function cartData()
    {
        $this->getCartProducts();
        return [
            'cartProducts'       => $this->cartProducts,
            'eagerProducts'      => Product::whereIn('id', $this->cartProducts)->get(),
            'productCountValues' => array_count_values($this->cartProducts),
        ];
    }

}
