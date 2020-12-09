<div class="product-categories-wrapper py-3">
    <div class="container">
        <div class="section-heading">
            <h6 class="ml-1">{{$title}}</h6>
        </div>
        <div class="product-category-wrap">
            <div class="row g-3">

                {{-- Single Category Card --}}
                @foreach($categories as $category)
                    <div class="col-4 col-md-2">
                        <div class="card category-card">
                            <div class="card-body p-0">
                                <a href="{{route('showCategory',['category'=>$category->slug])}}">
                                    <img src="{{url('storage/categories/').'/'.$category->icon}}"
                                         width="50%" alt="{{$category->name}}" class="my-2">
                                    <span class="mb-1">{{$category->name}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
