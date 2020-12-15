<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Traits\RetrieveCartData;
use App\Http\Livewire\Frontend\Traits\Wishlist;
use App\Models\GeneralOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrdersController extends Controller
{
    use RetrieveCartData;
    use Wishlist;

    /**
     * Display the purchase history.
     *
     */
    public function show()
    {
        return view('frontend.my-orders.show', $this->getAllViewData());
    }

    /**
     * Cancel the selected order.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function cancelOrder(Request $request)
    {
        $request->validate(['order' => 'required|numeric']);
        $this->userOrders()->whereId($request->order)->firstOrFail()->update(['status' => 8]);
        return back();
    }

    /**
     * Get all the data for passing to view.
     *
     * @return array
     */
    protected function getAllViewData()
    {
        return array_merge($this->cartData(), $this->allWishlistProductsData(), $this->allOrders(), GeneralOption::allCreditCard());
    }

    /**
     * Get all the orders data and sorting them.
     *
     * @return array
     */
    protected function allOrders()
    {
        return ['orders' => $this->userOrders()->orderByDesc('created_at')->paginate(3)];
    }

    /**
     * Get all the orders data of Auth user and exclude the deleted ones.
     *
     */
    protected function userOrders()
    {
        return Auth::user()->orders()->whereNotIn('status', [9]);
    }
}
