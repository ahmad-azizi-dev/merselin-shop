<div class="flash-sale-wrapper">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1 text-danger">@lang('mainFrontend.FlashSale')</h6><a class="btn btn-danger btn-sm" href="#">
                @lang('mainFrontend.ViewAll')
            </a>
        </div>
        {{--  Flash Sale Slide--}}
        <div class="flash-sale-slide owl-carousel">

            <!-- Single Flash Sale Card-->
            @foreach($FlashSaleProducts as $product)
                <div class="card flash-sale-card">
                    <div class="card-body"><a href="#"><img src="

                {{ url('/').'/storage/photos/'. $product->medias->whereIn('original_name',['1.jpg','1.png'])->pluck('path')->get(0) }}

                                " alt=""><span class="product-title">{{$product->title}}</span>
                            <p class="sale-price"> {{$product->discount_price}} <span
                                    class="real-price"> {{$product->price}}  </span> @lang('mainFrontend.Currency')</p>
                            <span
                                class="progress-title">{{$product->getDiscountedPricePercentage()}}٪ @lang('mainFrontend.Discount') </span>
                            <!-- Progress Bar-->
                            <div class="progress">
                                <div
                                    class="progress-bar @if($product->getDiscountedPricePercentage()>15)bg-danger @endif "
                                    role="progressbar" style="width: {{100-$product->getDiscountedPricePercentage()}}%"
                                    aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </a></div>
                </div>
            @endforeach
        </div>
    </div>
</div>
