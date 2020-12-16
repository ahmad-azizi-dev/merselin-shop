@foreach($products as $product)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="card top-product-card">
            <div class="card-body"><span class="badge badge-warning">HOT</span>
                @if(!in_array($product->id, $wishlistProducts, true))
                    <button wire:click="addToWishlist({{$product->id}})"
                            class="wishlist-btn btn p-1 m-0">
                        <i class="lni lni-heart font-normal"></i>
                    </button>
                @else
                    <a class="wishlist-btn btn p-1 m-0" data-toggle="modal"
                       data-target="#removeFromWishlist{{$product->id}}">
                        <i class="lni lni-heart-filled"></i>
                    </a>
                @endif
	            @push('product-grid') @include('frontend.partials.wishlist-modal') @endpush
                <a class="product-thumbnail d-block mb-2"
                   href="{{route('showProduct',['slug'=>$product->slug])}}">
                    <x-product-img :product=$product></x-product-img>
                </a>
                <a class="product-title d-block" href="{{route('showProduct',['slug'=>$product->slug])}}">
                    {{$product->title}}
                </a>
                <p class="sale-price">
                    <span class="@if(!$product->discount_price)text-decoration-none @endif ">
                        {{number_format($product->price)}}
                    </span>
                    {{$product->discount_price?number_format($product->discount_price):''}} @lang('mainFrontend.Currency')
                </p>
                <div class="product-rating">
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-filled"></i>
                    <i class="lni lni-star-half"></i>
                    <i class="lni lni-star-empty"></i>
                </div>
                @if(!in_array($product->id, $cartProducts, true))
                    <a wire:click="addToCart({{ $product->id }})" style="width: 25px; height: 25px;"
                       class="btn badge-success text-white d-flex justify-content-center align-items-center">
                        <i class="lni lni-cart"></i>
                    </a>
                @else
                    <button type="button" class="btn badge-danger text-white d-flex justify-content-center align-items-center" data-toggle="modal"
                            data-target="#removeFromCart{{$product->id}}" style="width: 25px; height: 25px">
                        <i class="lni lni-cart-full"></i>
                    </button>
                @endif
	            @push('product-grid') @include('frontend.partials.cart-modal') @endpush
            </div>
        </div>
	    @stack('product-grid')
    </div>
@endforeach
