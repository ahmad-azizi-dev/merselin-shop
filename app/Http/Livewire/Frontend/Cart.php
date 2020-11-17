<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Livewire\Frontend\Traits\CartTrait;
use Livewire\Component;

class Cart extends Component
{
    use CartTrait;

    public $totalPrice = 0;

    public function mount()
    {
        $this->getEagerProducts();
    }

    public function render()
    {
        return view('livewire.frontend.cart');
    }

    protected function getEagerProducts()
    {
        $this->getProductsData();
        $this->getTotalPrice();
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
