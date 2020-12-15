<?php

namespace App\Http\Livewire\Frontend\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

trait Wishlist
{
    public $wishlistProducts;
    public $wishlistProductsData;

    /**
     * Add a product to the user wishlist.
     *
     * @param  $productId
     */
    public function addToWishlist($productId): void
    {
        $this->getWishlistSession();
        $this->addToWishlistProducts($productId);
        $this->storeWishlist();
        $this->getWishlistProductsData();
        $this->emit('addedWishlist');
    }

    /**
     * Remove a product from the user wishlist.
     *
     * @param $productId
     */
    public function removeFromWishlist($productId): void
    {
        $this->getWishlistSession();
        unset($this->wishlistProducts[array_search($productId, $this->wishlistProducts, true)]);
        $this->storeWishlist();
        $this->getWishlistProductsData();
        $this->emit('removedWishlist');
    }

    /**
     * Get wishlist product IDs from the session.
     *
     * @return void
     */
    protected function getWishlistSession(): void
    {
        $this->wishlistProducts = (session()->has('wishlist') ? session('wishlist') : []);
    }

    /**
     * Store wishlist product IDs in the storage.
     *
     * @return void
     */
    protected function storeWishlist(): void
    {
        $this->wishlistProducts = array_values(array_unique($this->wishlistProducts)); //re-index array
        session(['wishlist' => $this->wishlistProducts]);
        if (auth::check()) {
            Auth::user()->wishlist()->updateOrCreate(['user_id' => Auth::id()], ['data' => $this->wishlistProducts]);
        }
    }

    /**
     * Initialize wishlist product IDs.
     *
     * @return void
     */
    protected function initializeWishlist(): void
    {
        $this->getWishlistSession();
        if (auth::check()) {
            $wishlist = Auth::user()->wishlist()->first();
            // union the session and database data
            $this->wishlistProducts = array_merge($this->wishlistProducts, ($wishlist->data ?? []));
            $this->storeWishlist();
        }
    }

    /**
     * Add a product ID to wishlist product array.
     *
     * @param $productId
     * @return void
     */
    protected function addToWishlistProducts($productId): void
    {
        if (count($this->wishlistProducts) < 50) {
            $this->wishlistProducts[] = $productId;
        }
    }

    /**
     * Get the wishlist product data.
     *
     * @return void
     */
    protected function getWishlistProductsData(): void
    {
        $this->wishlistProductsData = Product::whereIn('id', $this->wishlistProducts)->get();
    }

    /**
     * Retrieve all the wishlist product data.
     *
     * @return array
     */
    protected function allWishlistProductsData(): array
    {
        $this->initializeWishlist();
        $this->getWishlistProductsData();
        return [
            'wishlistProducts'     => $this->wishlistProducts,
            'wishlistProductsData' => $this->wishlistProductsData,
        ];
    }

}
