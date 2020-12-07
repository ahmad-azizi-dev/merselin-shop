<?php

namespace App\Http\Livewire\Frontend;

use App\Http\Livewire\Frontend\Traits\CartTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    use CartTrait;

    public $product = [];
    public $currentUrl = [];
    protected $listeners = ['removeFromCart' => 'removeFromCart'];

    public function mount()
    {
        $this->authCheckAndLoading();
    }

    public function render()
    {
        return view('livewire.frontend.product');
    }

    protected function getEagerProducts()
    {
        $this->getProductsData();
    }

    protected function getEagerProductGuest()
    {
        $this->productCountValues = array_count_values($this->cartProducts);
    }

    protected function authCheckAndLoading()
    {
        if (Auth::check()) {
            $this->getEagerProducts();
        } else {
            $this->getEagerProductGuest();
        }
    }
}
