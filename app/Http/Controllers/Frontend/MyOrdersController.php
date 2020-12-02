<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\Traits\RetrieveCartData;
use Illuminate\Support\Facades\Auth;

class MyOrdersController extends Controller
{
    use RetrieveCartData;

    /**
     * Display the purchase history.
     *
     */
    public function show()
    {
        return view('frontend.my-orders.show', $this->getAllViewData());
    }

    /**
     * Get all the data for passing to view.
     *
     * @return array
     */
    protected function getAllViewData()
    {
        return array_merge($this->cartData(), [
            'orders' => Auth::user()->orders()->get(),
        ]);
    }

}
