<?php

namespace App\Http\Livewire\Frontend\Traits;

use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

trait CouponTrait
{
    public $couponCode;
    public $couponMessage;
    public $couponData;
    public $withoutCouponPrice;

    /**
     * Check and validate a entered coupon by user.
     *
     * @return void
     */
    public function checkCoupon()
    {
        $this->validate();

        if ($this->couponData = Coupon::checkCode($this->couponCode)) {
            $this->addCoupon();
        } else {
            $this->invalidCouponMessage();
        }
    }

    /**
     * Remove the valid entered coupon by user.
     *
     * @return void
     */
    public function removeCoupon()
    {
        $this->couponData = null;
        $this->storeCouponData();
        $this->getEagerProducts();
        $this->emit('Coupon', trans('product.removeCoupon'));
    }

    /**
     * Show invalid coupon message to user.
     *
     * @return void
     */
    protected function invalidCouponMessage()
    {
        $this->emit('Coupon');
        $this->couponMessage = trans('mainFrontend.CorrectCode');
    }

    /**
     * Add valid coupon.
     *
     * @return void
     */
    protected function addCoupon()
    {
        $this->storeCouponData();
        $this->getEagerProducts();
        $this->emit('Coupon', trans('product.addCoupon'));
        $this->couponMessage = '';
    }

    /**
     * Store coupon data in the session.
     *
     * @return void
     */
    protected function storeCouponData()
    {
        session(['couponData' => $this->couponData]);
    }

    /**
     * Get coupon data from the session.
     *
     * @return void
     */
    protected function getCouponData()
    {
        $this->couponData = session('couponData');
    }

    /**
     * Calculate the total price with coupon.
     *
     * @return void
     */
    protected function calculateCouponPrice()
    {
        if ($this->couponData && Auth::check()) {
            $this->withoutCouponPrice = $this->totalPrice;
            $this->totalPrice -= $this->couponData->price;
        }
    }

}
