<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Traits\RetrieveCartData;
use App\Models\GeneralOption;
use App\Models\Order;
use App\Models\ShippingMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    use RetrieveCartData;

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
            'data'    => $this->getOrderedDataArray(), //will be serialized into JSON by eloquent mutators
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
     * Get the ordered data in array.
     *
     * @return array
     */
    protected function getOrderedDataArray()
    {
        return [
            'preparedCartData'       => session('preparedCartData'),
            'couponData'             => session('couponData'),
            'selectedShippingMethod' => ShippingMethod::selectedShippingMethod(),
            'orderedPrice'           => session('orderedPrice'),
        ];
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
