<!-- Product Slides-->

<div class="product-slides owl-carousel">
    <!-- Single Slide-->
    @for ($i = 2; $i <= count($medias=$product->medias); $i++)
        <a class="z1" onclick="event.preventDefault()" href="{{ url('/').'/storage/photos/2'.
        ($path=$medias->whereIn('original_name',["$i.jpg","$i.png"])->pluck('path')->get(0)) }}">
            <div class="single-product-slide" style="background-image: url('{{ url('/').'/storage/photos/'.$path }}')">
                <div class="magnifier">
                    <i class="lni lni-search-alt"></i>
                    @lang('product.magnifier')
                </div>
            </div>
        </a>
    @endfor
</div>

<div class="product-description">
    <!-- Product Title & Meta Data-->
    <div class="product-title-meta-data bg-white mb-3 py-3">
        <div class="container d-flex justify-content-between">
            <div class="p-title-price">
                <h6 class="mb-1">{{$product->title}} </h6>
                <p class="sale-price mb-2">
                    @if($product->discount_price)
                        {{number_format($product->discount_price)}} @lang('mainFrontend.Currency')
                        <span>{{number_format($product->price)}} @lang('mainFrontend.Currency')</span>
                    @else
                        {{number_format($product->price)}} @lang('mainFrontend.Currency')
                    @endif
                </p>
            </div>
            <div class="p-wishlist-share mr-2">
	            <a id="wishlist-false" class="p-1 m-0 d-none"
	               onClick="Livewire.emit('addToWishlist',{{ $product->id }})">
		            <i class="lni lni-heart"></i>
	            </a>
	            <a id="wishlist-true" class="p-1 m-0 d-none" data-toggle="modal"
	               data-target="#removeFromWishlist{{$product->id}}">
		            <i class="lni lni-heart-filled"></i>
	            </a>
	            @push('modal') @include('frontend.partials.wishlist-modal') @endpush
            </div>
        </div>
        <!-- Ratings-->
        <div class="product-ratings">
            <div class="container d-flex align-items-center justify-content-between">
                <div class="ratings"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                        class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i
                        class="lni lni-star-filled"></i>
                    <span class="pl-1">3 @lang('product.ratings')</span>
                </div>
                <div class="total-result-of-ratings">
                    <span>5.0 </span>
                    <span>@lang('product.veryGood')</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Sale Panel-->

    <!-- Selection Panel-->
    <div class="selection-panel bg-white mb-3 py-3">
        <div class="container">
            <!-- Categories-->
            <h6>@lang('product.categories')</h6>
            <p class="my-0">
                @foreach($product->categories as $category)
                    <span class="d-inline-block"> <i class="lni lni-chevron-left-circle ml-2"></i>
                        <a href="{{route('showCategory',['category'=>$category->slug])}}">{{$category->name}}</a>
                    </span>
                @endforeach
            </p>
        </div>
    </div>
</div>
