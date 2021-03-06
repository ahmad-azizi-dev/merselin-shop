<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Traits\RetrieveCartData;
use App\Http\Livewire\Frontend\Traits\Wishlist;
use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    use RetrieveCartData;
    use Wishlist;

    protected $cartProducts;

    /**
     * Display the checkout.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if (Auth::user()->name != 'not_set') {
            if ($this->checkPreviousData()) {
                return view('frontend.checkout.show', $this->getAllViewData());
            }
            return redirect(route('cart'));
        }
        return redirect(route('editProfile'));
    }

    /**
     * store the selected shipping method data in session.
     *
     * @param Request $request
     * @return void
     */
    public function postCheckout(Request $request)
    {
        $request->validate(['shippingMethod' => 'required']);
        session(['selectedShippingMethod' => $request->shippingMethod]);
        return redirect(route('checkoutPayment'));
    }

    /**
     * Display the checkout payment page for selecting a payment method.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkoutPayment()
    {
        if (URL::previous() === route('postCheckout') && session()->has('selectedShippingMethod')) {
            return view('frontend.checkout.checkout-payment', $this->getCheckoutPaymentViewData());
        }
        return redirect(route('home'));
    }

    /**
     * check the previous URL and session for correct performance.
     *
     * @return boolean
     */
    protected function checkPreviousData()
    {
        return Str::contains(URL::previous(), [route('editProfile'), route('cart')]) & session::has('preparedCartData');
    }

    /**
     * Get all the data for passing to checkoutPayment view.
     *
     * @return array
     */
    protected function getCheckoutPaymentViewData()
    {
        session([
            'orderedPrice' => ShippingMethod::whereId(session('selectedShippingMethod'))->firstOrFail()->price +
                Session('preparedCartData')['totalPrice']
        ]);
        return array_merge($this->cartData(), $this->allWishlistProductsData());
    }

    /**
     * Get all the data for passing to view.
     *
     * @return array
     */
    protected function getAllViewData()
    {
        return array_merge($this->cartData(), $this->allWishlistProductsData(), [
            'user'            => Auth::user()->load('shippingAddress'),
            'shippingMethods' => ShippingMethod::allShipping(),
        ]);
    }

}
