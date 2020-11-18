<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>{{__('product.billingInformation')}}</title>
        <script src="{{asset('js/alpine.min.js')}}"></script>
    @endpush

<!-- Header Area-->
    @include('frontend.checkout.header',['title' => trans('product.billingInformation')])
    @include('frontend.partials.SidebarWrapper')

    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div x-data="{shippingMethods: {{$shippingMethods}}, selectedMethod:
                 {{Session::has('selectedShippingMethod')?Session('selectedShippingMethod'):$shippingMethods[0]->id}},
                 cartTotalPrice: {{Session('preparedCartData')['totalPrice']}} }"
                 class="checkout-wrapper-area py-3">
                <!-- Billing Address-->
                <div class="billing-information-card mb-3">
                    <div class="card billing-information-title-card bg-danger">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">@lang('mainFrontend.Profile')</h6>
                        </div>
                    </div>
                    <div class="card user-data-card">
                        <div class="card-body">
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center">
                                    <i class="lni lni-user"></i>
                                    <span>@lang('mainFrontend.FullName')</span>
                                </div>
                                <div class="data-content">{{$user->name}}</div>
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center">
                                    <i class="lni lni-phone"></i>
                                    <span>@lang('mainFrontend.PhoneNumber')</span></div>
                                <div class="data-content">0{{$user->phone_number}}</div>
                            </div>
                            <div class="single-profile-data d-flex align-items-center justify-content-between">
                                <div class="title d-flex align-items-center">
                                    <i class="lni lni-envelope"></i>
                                    <span>@lang('product.email')</span>
                                    <span class="text-danger ml-1">@lang('mainFrontend.Optional')</span>
                                </div>
                                <div class="data-content">
                                    {{Str::startsWith($user->email,'not_set-')?'---':$user->email}}
                                </div>
                            </div>
                            <div class="single-profile-data d-flex justify-content-between">
                                <div class="title">
                                    <i class="lni lni-map-marker"></i><span>@lang('mainFrontend.ShippingAddress')</span>
                                </div>
                                <div class="data-content mt-1">{{$user->shippingAddress->shipping_address}}</div>
                            </div>

                            <!-- Edit Address-->
                            <a class="btn btn-danger w-50 px-0" href="{{route('editProfile')}}">
                                @lang('product.billingEdit')
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Shipping Method Choose-->
                <div class="shipping-method-choose mb-3">
                    <div class="card shipping-method-choose-title-card bg-success">
                        <div class="card-body">
                            <h6 class="text-center mb-0 text-white">@lang('product.shippingMethodChoose')</h6>
                        </div>
                    </div>
                    <div class="card shipping-method-choose-card">
                        <div class="card-body">
                            <div class="shipping-method-choose">
                                <ul class="pl-0">
                                    <form action="{{route('postCheckout')}}" method="post" id="postCheckout">
                                        @csrf
                                        @include('frontend.checkout.shipping-methods')
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cart Amount Area-->
                <div class="card cart-amount-area">
                    @include('frontend.checkout.cartAmountArea')
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Nav-->
    @include('frontend.partials.footerNav')

    @push('script')
        <script>
            @include('frontend.partials.DropdownMenu')
        </script>
    @endpush

</x-frontend-layout>

