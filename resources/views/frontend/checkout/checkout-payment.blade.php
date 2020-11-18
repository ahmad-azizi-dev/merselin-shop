<x-frontend-layout>

    @push('head')
        <meta name="description" content="---">
        <!-- Title-->
        <title>{{__('product.paymentMethod')}}</title>
    @endpush

<!-- Header Area-->
    @include('frontend.checkout.header',['title' => trans('product.paymentMethod')])
    @include('frontend.partials.SidebarWrapper')

    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area py-3">
                <div class="credit-card-info-wrapper mb-5">
                    <img class="d-block mb-4" src="{{asset('img/payment-method.png')}}" alt="payment method">
                </div>
                <!-- Choose Payment Method-->
                <div class="choose-payment-method">
                    <h6 class="mb-3 text-center">{{__('product.choosePaymentMethod')}}</h6>
                    <div class="row justify-content-center g-3">
                        <!-- Single Payment Method-->
                        <div class="col-6 col-md-5">
                            <div class="single-payment-method">
                                <a class="credit-card" href="#">
                                    <i class="lni lni-credit-cards"></i>
                                    <h6>{{__('product.creditCard')}}</h6>
                                </a>
                            </div>
                        </div>
                        <!-- Single Payment Method-->
                        <div class="col-6 col-md-5">
                            <div class="single-payment-method">
                                <a class="bank p-4" href="#">
                                    <img class="d-block mx-auto mt-4 mb-3" width="80px"
                                         src="{{asset('img/internetPayment.png')}}" alt="payment method">
                                    <h6 class="mb-3 mt-1">{{__('product.bank')}}</h6>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Cart Amount Area-->
                <div class="card cart-amount-area mt-3">
                    <div class="card-body d-flex justify-content-between my-1">
                        <h6>{{__('product.totalCartAmount')}}</h6>
                        <div class="text-warning">
                            {{number_format($shippingMethodPrice+Session('preparedCartData')['totalPrice'])}}
                            @lang('mainFrontend.Currency')
                        </div>
                    </div>
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

