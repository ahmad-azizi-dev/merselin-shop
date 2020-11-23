@auth()
    <div class="card coupon-card mb-3">
        <div class="card-body">
            <div class="apply-coupon">
                <div class="{{$couponData?'d-none':''}}">
                    <h6 class="mb-0 ml-1">@lang('mainFrontend.Coupon')</h6>
                    <p class="mb-2">@lang('mainFrontend.EnterCoupon')</p>
                    <div class="coupon-form">
                        <form id="coupon">
                            <input wire:model.defer="couponCode" class="form-control" type="text"
                                   name="couponCode" placeholder="@lang('mainFrontend.SampleCoupon')">
                            <button class="btn badge-primary text-white" type="submit">
                                <span wire:target="couponCode"
                                      wire:loading.class="spinner-border spinner-border-sm text-white mb-1">
                                </span>
                                @lang('mainFrontend.Check')
                            </button>
                            <p id="couponCode-error" class="text-danger my-1 ml-1">
                                @error('couponCode') {{ $message }} @enderror
                                {{$couponMessage}}
                            </p>
                        </form>
                    </div>
                </div>
                @if($couponData)
                    <h6 class="mb-0 text-success ml-1">
                        @lang('product.couponCode')
                    </h6>
                    <p class="mb-1 font-weight-bold">{{$couponData->title}}
                        <span class="mb-2 text-danger ml-2">
                            {{number_format($couponData->price)}} @lang('mainFrontend.Currency')
                        </span>
                        <a wire:click="removeCoupon" class="btn badge-danger text-white btn-sm px-2 ml-2">
                           <span wire:target="removeCoupon"
                                 wire:loading.class="spinner-border spinner-border-sm text-white mb-1">
                           </span>
                            @lang('mainFrontend.Delete')
                        </a>
                    </p>
                @endif

            </div>
        </div>
    </div>
@endauth
