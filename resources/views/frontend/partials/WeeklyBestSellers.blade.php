<div class="weekly-best-seller-area py-3">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="pl-1">@lang('mainFrontend.WeeklyBestSellers')</h6>
            <a class="btn btn-success btn-sm" href="#"> @lang('mainFrontend.ViewAll') </a>
        </div>
        <div class="row g-3">
            <!-- Single Weekly Product Card-->

            @foreach($TopProducts as $product)
                <div class="col-12 col-md-6">
                    <div class="card weekly-product-card">
                        <div class="card-body d-flex align-items-center">
                            <div class="product-thumbnail-side">
                                <span class="badge badge-warning">HOT</span>
                                <a class="wishlist-btn" href="#"><i class="lni lni-heart"></i></a>
                                <a class="product-thumbnail d-block"
                                   href="{{route('showProduct',['slug'=>$product->slug])}}">
                                    <x-product-img :product=$product></x-product-img>
                                </a>
                            </div>
                            <div class="product-description">
                                <a class="product-title d-block"
                                   href="{{route('showProduct',['slug'=>$product->slug])}}">
                                    {{$product->title}}
                                </a>
                                <p class="sale-price">
                                    @if($product->discount_price)
                                        {{number_format($product->discount_price)}}@lang('mainFrontend.Currency')
                                        <span
                                            style="font-size: inherit">{{number_format($product->price)}} @lang('mainFrontend.Currency')
                                        </span>
                                    @else
                                        {{number_format($product->price)}} @lang('mainFrontend.Currency')
                                    @endif
                                </p>
                                <div class="product-rating"><i class="lni lni-star-filled"></i>4.88 (39)</div>

                                @if(!in_array($product->id, $cartProducts))
                                    <a wire:click="addToCart({{ $product->id }})"
                                       class="btn badge-success text-white btn-sm ">
                                        <i class="mr-1 lni lni-cart"></i>@lang('mainFrontend.BuyNow')
                                    </a>
                                @else
                                    <a wire:click="removeFromCart({{ $product->id }})"
                                       class="btn badge-danger text-white btn-sm ">
                                        <i class="mr-1 lni lni-cart-full"></i>@lang('mainFrontend.Delete')
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
