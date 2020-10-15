<div class="product-categories-wrapper py-3">
    <div class="container">
        <div class="section-heading">
            <h6 class="ml-1">@lang('mainFrontend.ProductCategories')</h6>
        </div>
        <div class="product-category-wrap">
            <div class="row g-3">

                {{-- Single Category Card --}}
                @foreach($categories as $category)
                    <div class="col-4">
                        <div class="card category-card">
                            <div class="card-body"><a href="#"><i class="lni lni-tshirt"></i>
                                    <span>{{$category->name}}</span></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
