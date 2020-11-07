<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Cart as CartFacade;
use App\Models\Product;
use App\Models\Product as ProductModel;

trait cartTrait
{
    public $cartProducts = [];
    public $eagerProducts = [];
    public $productCountValues = [];

    public function addToCart(int $productId)
    {
        CartFacade::add(Product::where('id', $productId)->first());
        $this->cartProducts = CartFacade::get()['products'];
        $this->getEagerProducts();
        $this->emit('productAdded', $this->cartTotal());
    }

    public function removeFromCart($productId, $removeType = 'all')
    {
        $this->typeCheckAndRemove($productId, $removeType);
        $this->cartProducts = CartFacade::get()['products'];
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
        $this->eagerProducts = ProductModel::with('medias')->whereIn('id', $this->cartProducts)->get();
        $this->productCountValues = array_count_values($this->cartProducts);
    }
}
