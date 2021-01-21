@foreach($order->product_data as $product)
	<div class="col-4 col-sm-4 col-lg-3 px-2">
		<div class="card flash-sale-card my-2">
			<div class="card-body p-2">
				<a href="{{route('showProduct',['slug'=>$product->slug])}}">
					<x-product-img :product=$product></x-product-img>
					<span class="product-title" style="font-size: 9pt">
						{{$product->title}}
					</span>
					<p style="font-size: 9pt" class="my-0 text-danger">
						<span class="text-secondary">@lang('product.quantity')</span>
						{{$order->product_quantity[$product->id]}}
						@lang('product.unit')
					</p>
				</a>
			</div>
		</div>
	</div>
@endforeach