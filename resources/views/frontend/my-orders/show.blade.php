<x-frontend-layout>
	
	@push('head')
		<meta name="description" content="---">
		<!-- Title-->
		<title>{{__('mainFrontend.PurchaseHistory')}}</title>
	@endpush

<!-- Header Area-->
	@include('frontend.partials.HeaderArea')
	@include('frontend.partials.SidebarWrapper')
	
	<div class="page-content-wrapper">
		<div class="container">
			<div class="my-order-wrapper py-4">
				
				<!-- Single Order-->
				@forelse($orders as $order)
					<div class="single-order-status">
						<div class="card bg-warning mb-3">
							<div class="card-body d-flex align-items-center">
								@switch($order->status)
									@case(0)
									<div class="order-icon"><i class="lni lni-timer"></i></div>
									<div class="order-status">@lang('product.waitingPayment')</div>
									@break @case(1)
									<div class="order-icon"><i class="lni lni-spinner-arrow"></i></div>
									<div class="order-status">@lang('product.preparing')</div>
									@break @case(2)
									<div class="order-icon"><i class="lni lni-delivery"></i></div>
									<div class="order-status">@lang('product.sending')</div>
									@break @case(3)
									<div class="order-icon"><i class="lni lni-checkmark-circle"></i></div>
									<div class="order-status">@lang('product.delivered')</div>
									@break
								@endswitch
								<div class="order-status ml-1">
									<span class="order-date">{{$order->created_at->diffForHumans()}}</span>
									<span class="order-date">
										{{Verta::instance($order->created_at->setTimezone('Asia/Tehran'))->format('%d %B %Y')}}
									</span>
								</div>
							</div>
						</div>
						<div class="row g-3">
							<!-- Single Ordered Product Card-->
							@foreach($order->product_data as $product)
								<div class="col-4 col-sm-4 col-lg-3">
									<div class="card flash-sale-card">
										<div class="card-body">
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
						
						</div>
					</div>
				@empty
					<div class="col-md-12 text-center">
						<br>
						<div class="mt-3"> @lang('product.emptyPurchaseHistory')</div>
						<img width="300px" src="{{asset('img/emptyCart.png')}}" alt="emptyPurchaseHistory">
					</div>
				@endforelse
			
			</div>
		</div>
	</div>
	
	<!-- Footer Nav-->
	@include('frontend.partials.footerNav')
	
	@push('script')
		<script>
			@include('frontend.partials.DropdownMenu')
		</script>
	@endpush

</x-frontend-layout>

