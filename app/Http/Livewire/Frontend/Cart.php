<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Livewire\Frontend\Traits\CartTrait;
use App\Http\Livewire\Frontend\Traits\CouponTrait;
use App\Http\Livewire\Frontend\Traits\Wishlist;
use Livewire\Component;

class Cart extends Component
{
    use CartTrait;
    use Wishlist;
    use CouponTrait;

    public $totalPrice;
    protected $listeners = [
        'checkCoupon'    => 'checkCoupon',
        'removeFromCart' => 'removeFromCart'];
    protected $rules = [
        'couponCode' => 'required|string|min:5|max:10',
    ];

    public function mount()
    {
        $this->getCouponData();
        $this->initializeWishlist();
        $this->getEagerProducts();
    }

    public function render()
    {
        return view('livewire.frontend.cart');
    }

    /**
     * Retrieve and calculate all needed data in cart page.
     *
     * @return void
     */
    protected function getEagerProducts()
    {
        $this->getProductsData();
        $this->getWishlistProductsData();
        $this->getTotalPrice();
        $this->storeCartData();
    }

    /**
     * Store cart data in the session.
     *
     * @return void
     */
    protected function storeCartData()
    {
        session(['preparedCartData' => [
            'cartProducts' => $this->cartProducts,
            'totalPrice'   => $this->totalPrice
        ]]);
    }

    /**
     * Get the total price of cart data.
     *
     * @return void
     */
    protected function getTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->eagerProducts as $product) {
            $this->summationPrices($product);
        }
        $this->calculateCouponPrice();
    }

    /**
     * Get the sum price.
     *
     * @param $product
     * @return void
     */
    protected function summationPrices($product)
    {
        if ($product->discount_price) {
            $this->totalPrice += $product->discount_price * $this->productCountValues[$product->id];
        } elseif ($product->price) {
            $this->totalPrice += $product->price * $this->productCountValues[$product->id];
        }
    }

}
