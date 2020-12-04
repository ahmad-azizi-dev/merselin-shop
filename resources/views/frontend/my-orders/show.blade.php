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
					@include('frontend.my-orders.single-order')
				@empty
					<div class="col-md-12 text-center">
						<br>
						<div class="mt-3"> @lang('product.emptyPurchaseHistory')</div>
						<img width="300px" src="{{asset('img/emptyCart.png')}}" alt="emptyPurchaseHistory">
					</div>
				@endforelse
				@if($orders->count())
					<div class="text-center mx-2 mb-5">{{$orders->links()}}</div>
				@endif
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

