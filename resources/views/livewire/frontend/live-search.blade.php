<div class="search-box">
	<div class="card pt-1">
		@foreach($products as $product)
			<a href="{{route('showProduct',['slug'=>$product->slug])}}">
				<p class="mx-2 my-0">
				<div>
					<x-product-img :product=$product></x-product-img>
				</div>
				{{Str::limit($product->title, 22)}}
				</p>
			</a>
		@endforeach
		@if(($categories?$categories->count():false))
			@if(($products?$products->count():false))
				<hr class="my-1 mx-2 text-primary">
			@endif
			<p class="mx-3 mb-1">@lang('mainFrontend.ProductCategories')</p>
		@endif
		@foreach($categories as $category)
			<a href="{{route('showCategory',['category'=>$category->slug])}}">
				<p class="mx-2 my-0">
				<div>
					<img src="{{url('storage/categories/').'/'.$category->icon}}">
				</div>
				{{Str::limit($category->name, 22)}}
				</p>
			</a>
		@endforeach
	</div>
</div>
