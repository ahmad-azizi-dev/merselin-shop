<div class="flash-sale-wrapper">
    <div class="container">
        <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1 text-danger">@lang('mainFrontend.FlashSale')</h6><a class="btn btn-danger btn-sm" href="#">
                @lang('mainFrontend.ViewAll')
            </a>
        </div>
        {{--  Flash Sale Slide--}}
        <div class="flash-sale-slide owl-carousel mt-3">

            <!-- Single Flash Sale Card-->
            @foreach($FlashSaleProducts as $product)
                <div class="card flash-sale-card">
                    <div class="card-body">
                        <a href="{{route('showProduct',['slug'=>$product->slug])}}">
                            <x-product-img :product=$product></x-product-img>

                            <span class="product-title">{{$product->title}}</span>
                            <p class="sale-price"> {{number_format($product->discount_price)}}
                                <span class="real-price"> {{number_format($product->price)}}</span>
                                @lang('mainFrontend.Currency')
                            </p>
                            <span class="progress-title">
                                {{$product->getDiscountedPricePercentage()}}٪ @lang('mainFrontend.Discount')
                            </span>
                            <!-- Progress Bar-->
                            <div class="progress">
                                <div
                                    class="progress-bar @if($product->getDiscountedPricePercentage()>15)bg-danger @endif "
                                    role="progressbar" style="width: {{100-$product->getDiscountedPricePercentage()}}%"
                                    aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
