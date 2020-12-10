<x-frontend-layout>
	
	@push('head')
		<meta name="description" content="---">
		<!-- Title-->
		<title>{{__('product.successfulOrder')}}</title>
	@endpush

<!-- Header Area-->
	@include('frontend.partials.HeaderArea')
	@include('frontend.partials.SidebarWrapper')
	
	<div class="page-content-wrapper">
		<div class="container">
			<!-- Checkout Wrapper-->
			<div class="checkout-wrapper-area py-3">
				<div class="credit-card-info-wrapper">
					<img class="d-block mb-4" width="35%" src="{{asset('img/successful-order.png')}}"
					     alt="successful-order">
					<div class="bank-ac-info">
						<h6 class="mx-2">{{__('product.successfulOrder')}}</h6>
						
						<div class="card cart-amount-area mt-3">
							<h6 class="text-success mx-3 mt-3">
								{{__('product.orderCode')}}
								<span class="text-secondary">{{Session('orderedCode')}}</span>
							</h6>
							<hr class="my-1 mx-2">
							<div class="card-body d-flex justify-content-between my-0">
								<h6>{{__('product.totalCartAmount')}}</h6>
								<div class="text-warning">
									{{number_format(Session('orderedPrice'))}}
									@lang('mainFrontend.Currency')
								</div>
							</div>
						</div>
						<p style="text-align: justify" class="m-1 my-3">{{$credit_card_payment_description}}</p>
						{!!$account_number!!}
					</div>
					<a class="btn btn-warning mx-2 py-2 w-50" href="{{route('home')}}">
						{{__('product.backHome')}}
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Footer Nav-->
	@include('frontend.partials.footerNav')
	
	@push('script')
		@livewireScripts
		<script>
			@include('frontend.partials.DropdownMenu')
		</script>
	@endpush

</x-frontend-layout>

