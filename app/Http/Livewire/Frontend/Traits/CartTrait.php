<?php

namespace App\Http\Livewire\Frontend\Traits;

use App\Facades\Cart as CartFacade;
use App\Models\Product;

trait CartTrait
{
    public $cartProducts = [];
    public $eagerProducts = [];
    public $productCountValues = [];

    public function addToCart(int $productId)
    {
        CartFacade::add($productId);
        $this->cartProducts = CartFacade::getProducts();
        $this->getEagerProducts();
        $this->emit('productAdded', $this->cartTotal());
    }

    public function removeFromCart($productId, $removeType = 'all')
    {
        $this->typeCheckAndRemove($productId, $removeType);
        $this->cartProducts = CartFacade::getProducts();
        $this->getEagerProducts();
        $this->emit('productRemoved', $this->cartTotal());
    }

    protected function cartTotal()
    {
        return count(array_unique($this->cartProducts));
    }

    protected function typeCheckAndRemove($productId, $removeType)
    {
        if ($removeType == 'all') {
            CartFacade::remove($productId);
        } else {
            CartFacade::removeSingle($productId);
        }
    }

    protected function getProductsData()
    {
        $this->eagerProducts = Product::whereIn('id', $this->cartProducts)->get();
        $this->productCountValues = array_count_values($this->cartProducts);
    }
}
