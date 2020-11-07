<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Product as ProductModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Product extends Component
{
    use cartTrait;

    public $product = [];
    public $currentUrl = [];

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
        $this->eagerProducts = ProductModel::with('medias')->whereId($this->product->id)->get();
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
