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
					<img class="d-block mb-4" width="50%" src="{{asset('img/successful-order.png')}}"
					     alt="successful-order">
					<div class="bank-ac-info">
						<h6 class="mx-2">{{__('product.successfulOrder')}}</h6>
						<h6 class="text-success m-3">
							{{__('product.orderCode')}}
							<span class="text-secondary">{{Session('orderedCode')}}</span>
						</h6>
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
		<script>
			@include('frontend.partials.DropdownMenu')
		</script>
	@endpush

</x-frontend-layout>

