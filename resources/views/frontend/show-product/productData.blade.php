<!-- Product Slides-->

<div class="product-slides owl-carousel">
    <!-- Single Slide-->
    @for ($i = 2; $i <= count($medias=$product->medias); $i++)
        <div class="single-product-slide" style="background-image: url('{{ url('/').'/storage/photos/'.
                 $medias->whereIn('original_name',["$i.jpg","$i.png"])->pluck('path')->get(0) }}')"></div>
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
                <a href="#">
                    <i class="lni lni-heart"></i>
                </a>
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

</div>
