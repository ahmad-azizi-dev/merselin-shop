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
			@break @case(8)
			<div class="order-icon"><i class="lni lni-cross-circle"></i></div>
			<div class="order-status">@lang('product.canceled')</div>
			@break
		@endswitch
		<div class="order-status ml-1">
			<span class="mx-2" style="font-size: 9pt">
				{{$order->created_at->diffForHumans()}}
			</span>
			<span style="font-size: 9pt">
				{{Verta::instance($order->created_at)->timezone('Asia/Tehran')->format('%d %B %Y')}}
			</span>
		</div>
	</div>
</div>