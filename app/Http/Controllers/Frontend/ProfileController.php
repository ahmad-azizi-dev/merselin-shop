<?php

namespace App\Http\Controllers\Frontend;

use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    protected $cartProducts;

    /**
     * Display the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('frontend.profile.show', $this->getAllViewData());
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->storePreviousUrl();
        return view('frontend.profile.edit', $this->getAllViewData());
    }

    /**
     * update the profile data and store in storage.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $request->validate($this->getValidationData());
        $this->saveAllInputs(Auth::user(), $request);

        return redirect(($url = session('previousProfileUrl')) ? $url : route('profile'))
            ->with('SuccessProfileEdit', trans('mainFrontend.SuccessProfileEdit'));
    }


    /**
     * Get the validation rules data.
     */
    protected function getValidationData()
    {
        return [
            'name'             => ['required', 'max:255', 'min:5'],
            'email'            => ['nullable', 'email', 'unique:users,email,' . Auth::id()],
            'shipping_address' => ['required', 'max:255', 'min:10'],
        ];
    }

    /**
     * Store the previous edit profile url in the session.
     */
    protected function storePreviousUrl()
    {
        if (!Str::contains($url = URL::previous(), ['profile/edit', 'otp-confirm']) & Str::contains($url, url('/'))) {
            session(['previousProfileUrl' => $url]);
        }
    }

    /**
     * Get all the data for passing to view.
     *
     * @return array
     */
    protected function getAllViewData()
    {
        $this->getCartProducts();
        return array_merge($this->cartData(), ['user' => Auth::user()->load('shippingAddress')]);
    }

    /**
     * Get the cart data.
     *
     * @return array
     */
    protected function cartData()
    {
        return [
            'cartProducts'       => $this->cartProducts,
            'eagerProducts'      => Product::whereIn('id', $this->cartProducts)->get(),
            'productCountValues' => array_count_values($this->cartProducts),
        ];
    }

    /**
     * Get the cart products.
     *
     * @return void
     */
    protected function getCartProducts()
    {
        $this->cartProducts = Cart::getProducts();
    }

    /**
     * save all the inputs in storage.
     *
     * @param $user
     * @param $request
     * @return void
     */
    protected function saveAllInputs($user, $request)
    {
        $user->update($this->getUserInputs($request));
        $user->shippingAddress()->updateOrCreate(['user_id' => $user->id], $request->only('shipping_address'));
    }

    /**
     * return an array of needed input columns for update the user .
     *
     * @param $request
     * @return array
     */
    protected function getUserInputs($request)
    {
        return array_merge($request->only('name'), $request->email ? ['email' => $request->email] : []);
    }
}