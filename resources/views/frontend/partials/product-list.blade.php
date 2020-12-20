@foreach($products as $product)
    <div class="col-12 col-md-6 px-2 mt-3">
        <div class="card weekly-product-card">
            <div class="card-body d-flex align-items-center">
                <div class="product-thumbnail-side p-0">
                    <span class="badge badge-warning">HOT</span>
                    @if(!in_array($product->id, $wishlistProducts, true))
                        <button wire:click="addToWishlist({{$product->id}})"
                           class="wishlist-btn btn p-1 m-0">
                            <i class="lni lni-heart"></i>
                        </button>
                    @else
                        <a class="wishlist-btn btn p-1 m-0" data-toggle="modal"
                                data-target="#removeFromWishlist{{$product->id}}">
                            <i class="lni lni-heart-filled"></i>
                        </a>
		                @push('product-list') @include('frontend.partials.wishlist-modal') @endpush
                    @endif
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

                    @if(!in_array($product->id, $cartProducts, true))
                        <a wire:click="addToCart({{ $product->id }})"
                           class="btn badge-success text-white btn-sm ">
                            <i class="mr-1 lni lni-cart"></i>@lang('mainFrontend.BuyNow')
                        </a>
                    @else
                        <button type="button" class="btn badge-danger text-white btn-sm" data-toggle="modal"
                                data-target="#removeFromCart{{$product->id}}">
                            <i class="mr-1 lni lni-cart-full"></i>@lang('mainFrontend.Delete')
                        </button>
		                @push('product-list') @include('frontend.partials.cart-modal') @endpush
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
@stack('product-list')
