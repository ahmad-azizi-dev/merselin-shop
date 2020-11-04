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
                    <div class="card coupon-card mb-3">
                        <div class="card-body">
                            <div class="apply-coupon">
                                <h6 class="mb-0">@lang('mainFrontend.Coupon')</h6>
                                <p class="mb-2">@lang('mainFrontend.EnterCoupon')</p>
                                <div class="coupon-form">
                                    <form action=" ">
                                        <input class="form-control" type="text"
                                               placeholder="@lang('mainFrontend.SampleCoupon')">
                                        <button class="btn badge-primary text-white"
                                                type="submit">@lang('mainFrontend.Check')
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cart Amount Area-->
                    <div class="card cart-amount-area">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h6 class="total-price mb-0">
                                <span class="counter">{{number_format($totalPrice)}}</span>
                                @lang('mainFrontend.Currency')
                            </h6>
                            <a class="btn btn-warning" href="#">@lang('mainFrontend.Next')</a>
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
