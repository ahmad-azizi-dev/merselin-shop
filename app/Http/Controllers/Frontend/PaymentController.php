<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\GeneralOption;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Process a submitted order.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function creditCard(Request $request)
    {
        if ($request->payment_method === 'credit-card') {
            $this->addOrder();
            return redirect(route('showCreditCardPayment'));
        }
        return redirect(route('home'));
    }

    /**
     * Show successful order submit page.
     */
    public function showCreditCard()
    {
        return view('frontend.payment.show-credit-card', $this->getCreditCardData());
    }

    /**
     * Add product order.
     *
     * @return void
     */
    protected function addOrder()
    {
        session(['orderedCode' => $this->storeOrderData()]);
        $this->setOrderedData();
    }

    /**
     * Store order data in orders table.
     *
     * @return string
     */
    protected function storeOrderData()
    {
        return Order::create([
            'user_id' => Auth::id(),
            'data'    => $this->getJsonOrderedData(),
            'status'  => 0,
            'code'    => $this->generateOrderCode(),
        ])->code;
    }

    /**
     * Change the status of the coupon to 0 and store in database.
     * Clear cart data.
     *
     * @return void
     */
    protected function setOrderedData()
    {
        if (session()->has('couponData')) {
            session('couponData')->update(['status' => 0]);
        }
        session()->forget(['cartProducts', 'couponData', 'selectedShippingMethod']);
        Cart::clear();
    }

    /**
     * Get all the data for passing to view.
     *
     * @return array
     */
    protected function getCreditCardData()
    {
        return array_merge($this->cartData(), GeneralOption::allCreditCard());
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

    /**
     * Get ordered data in JSON string form.
     *
     * @return false|string
     */
    protected function getJsonOrderedData()
    {
        return collect([
            'preparedCartData'       => session('preparedCartData'),
            'couponData'             => session('couponData'),
            'selectedShippingMethod' => session('selectedShippingMethod'),
        ])->tojson();
    }

    /**
     * Generate a random order code.
     *
     * @return false|string
     */
    protected function generateOrderCode()
    {
        $code = mt_rand(100000, 999999);
        if (Order::checkOrderCode($code)) {
            return $this->generateOrderCode();
        }
        return $code;
    }
}
