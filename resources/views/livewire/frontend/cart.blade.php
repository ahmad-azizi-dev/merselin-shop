<div>

    @include('frontend.partials.SidebarWrapper')

    <div class="page-content-wrapper">

        <x-loading></x-loading>

        @if($cartProducts)
            <div class="container">
                <!-- Cart Wrapper-->
                <div class="cart-wrapper-area py-3">
                    <div class="cart-table card mb-3">
                        <div class="table-responsive card-body">
                            <table class="table mb-0">
                                <tbody>

                                <x-products-cart :eagerProducts=$eagerProducts
                                                 :productCountValues=$productCountValues>
                                </x-products-cart>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Coupon Area-->
                @include('frontend.cart.coupon-area')

                <!-- Cart Amount Area-->
                    <div class="card cart-amount-area">
                        @if($couponData && Auth::check())
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <p class="total-price mb-0 mx-auto">
                                    <span class="price-title">@lang('product.couponCodeAmount')</span>
                                    <span class="text-danger price">{{number_format($couponData->price)}}</span>
                                    <span class="price">@lang('mainFrontend.Currency')</span>
                                </p>
                                <h5 class="m-auto">-</h5>
                                <p class="total-price mb-0 mx-auto">
                                    <span class="price-title">@lang('product.totalAmount')</span>
                                    <span class="text-danger price">{{number_format($withoutCouponPrice)}}</span>
                                    <span class="price">@lang('mainFrontend.Currency')</span>
                                </p>
                            </div>
                            <hr class="mt-0 mb-2 mx-4">
                        @endif
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h6 class="total-price my-0">
                                <span class="counter">{{number_format($totalPrice)}}</span>
                                @lang('mainFrontend.Currency')
                            </h6>
                            <a class="btn btn-warning" href="{{route('checkout')}}">@lang('mainFrontend.Next')</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-md-12 text-center">
                <br>
                <div class="mt-3"> @lang('mainFrontend.EmptyCart')</div>
                <img width="300px" src="{{asset('img/emptyCart.png')}}" alt="empty cart">
            </div>
        @endif

    </div>
</div>
