<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Cart extends Component
{
    use cartTrait;

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
    }

    protected function getTotalPrice()
    {
        $this->totalPrice = 0;
        foreach ($this->eagerProducts as $product) {
            if ($product->discount_price) {
                $this->totalPrice += $product->discount_price * $this->productCountValues[$product->id];
            } elseif ($product->price) {
                $this->totalPrice += $product->price * $this->productCountValues[$product->id];
            }
        }
    }

}
