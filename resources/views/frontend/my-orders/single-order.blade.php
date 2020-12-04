<div class="single-order-status mb-5">
	@include('frontend.my-orders.order-status')
	<div class="row g-3">
		<!-- Single Ordered Product Card-->
		@include('frontend.my-orders.single-ordered-product')
		
		<div class="card card-body mt-3 mx-2 p-0 billing-information-card">
			<div class="card billing-information-title-card bg-secondary">
				<div class="card-body p-2">
					<h6 class="m-0 text-white text-center" style="font-size: 10pt">
						@lang('product.orderCode')
						<span class="mx-1">{{$order->code}}</span>
					</h6>
				</div>
			</div>
			<h6 class="text-primary mx-3 mt-3">
				@lang('product.shippingMethod'):
			</h6>
			<p class="text-secondary mx-3 my-0">
				{{$order->data['selectedShippingMethod']['title']}}
				<span class="text-danger mx-2">
					{{number_format($order->data['selectedShippingMethod']['price'])}}
					@lang('mainFrontend.Currency')
				</span>
			</p>
			<hr class="my-1 mx-2">
			@if ($coupon=$order->data['couponData'])
				<h6 class="text-success mx-3 mt-3">
					@lang('product.couponCode'):
				</h6>
				<p class="text-secondary mx-3 my-0">
					{{$coupon['title']}}
					<span class="text-danger mx-2">
						{{number_format($coupon['price'])}}
						@lang('mainFrontend.Currency')
					</span>
				</p>
				<hr class="my-1 mx-2">
			@endif
			<div class="card-body d-flex justify-content-between my-0">
				<h6>{{__('product.totalCartAmount')}}</h6>
				<div class="text-danger">
					{{number_format($order->data['orderedPrice'])}}
					@lang('mainFrontend.Currency')
				</div>
			</div>
			
			@if ($order->status===0)
				<div class="mx-1">
					<p style="text-align: justify" class="m-1 my-3">
						{{$credit_card_payment_description}}
					</p>
					{!!$account_number!!}
				</div>
			@endif
		
		</div>
		@if(! in_array($order->status, [3,8], true))
			<button type="button" class="btn badge-danger text-white mx-3 w-25" data-toggle="modal"
			        data-target="#cancelOrder{{$order->id}}" style="min-width: 100px">
				@lang('product.cancelOrder')
			</button>
			@include('frontend.my-orders.cancel-order-modal')
		@endif
	</div>
</div>