<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CheckoutController extends Controller
{
    protected $cartProducts;

    /**
     * Display the checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::user()->name != 'not_set') {
            if (URL::previous() === route('cart')) {
                return view('frontend.checkout.show', $this->getAllViewData());
            }
            return redirect(route('cart'));
        }
        return redirect(route('editProfile'));
    }

    /**
     * store the checkout data.
     *
     * @param Request $request
     * @return void
     */
    public function postCheckout(Request $request)
    {
        dd($request->input());
    }

    /**
     * Get all the data for passing to view.
     *
     * @return array
     */
    protected function getAllViewData()
    {
        return array_merge($this->cartData(), [
            'user'            => Auth::user()->load('shippingAddress'),
            'shippingMethods' => ShippingMethod::allShipping(),
        ]);
    }

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
