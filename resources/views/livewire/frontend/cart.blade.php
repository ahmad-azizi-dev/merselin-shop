<div>
    <!-- loading-->
    <div wire:loading class="preloader2">
        <div class="preloader3">
            <div class="spinner-grow text-secondary"></div>
            <div class="text-primary">@lang('mainFrontend.Preloader')</div>
        </div>
    </div>

    @if($cartProducts)
        <div class="container">
            <!-- Cart Wrapper-->
            <div class="cart-wrapper-area py-3">
                <div class="cart-table card mb-3">
                    <div class="table-responsive card-body">
                        <table class="table mb-0">
                            <tbody>
                            @foreach($eagerProducts as $product)
                                <tr>
                                    <th style="width: 70px">
                                        <a wire:click="removeFromCart({{ $product->id }})"
                                           class="btn badge-danger text-white btn-sm p-1">
                                            <i class=" lni lni-cart-full"></i>
                                            @lang('mainFrontend.Delete')
                                        </a>
                                    </th>
                                    <td><img src="
                  {{ url('/').'/storage/photos/'. $product->medias->whereIn('original_name',['1.jpg','1.png'])->pluck('path')->get(0) }}
                                            " alt="{{$product->title}}">
                                    </td>
                                    <td><a href="#"> {{$product->title}}
                                            <span class="text-success">
                                                @if($product->discount_price)
                                                    <span class="text-decoration-line-through text-danger">{{$product->price}}
                                                        @lang('mainFrontend.Currency')
                                                    </span>
                                                    <i style="font-size: 11pt;" class="text-dark font-normal"> {{$productCountValues[$product->id]}} ×</i>
                                                    {{number_format($product->discount_price)}} @lang('mainFrontend.Currency')
                                                @else
                                                    <i style="font-size: 11pt;" class="text-dark font-normal"> {{$productCountValues[$product->id]}} ×</i>
                                                    {{number_format($product->price)}} @lang('mainFrontend.Currency')
                                                @endif
                                            </span>
                                        </a>
                                    </td>
                                    <td style="width: 65px;">
                                        <a wire:click="removeFromCart({{ $product->id .", 'single'"}})"
                                           class="btn badge-danger text-white btn-sm m-1">
                                            <i class="lni lni-minus"></i>
                                        </a>
                                        <a wire:click="addToCart({{ $product->id }})"
                                           class="btn badge-success text-white btn-sm m-1">
                                            <i class="lni lni-plus"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
                        <h5 class="total-price mb-0">
                            <span class="counter">{{number_format($totalPrice)}}</span>
                            @lang('mainFrontend.Currency')
                        </h5>
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
