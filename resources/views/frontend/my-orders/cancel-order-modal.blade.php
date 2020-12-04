@push('modal')
	<!-- The cancel order Modal -->
	<div class="modal fade mt-5" id="cancelOrder{{$order->id}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h5 class="modal-title text-danger">
						<i class="fa fa-window-close"></i>
						@lang('product.danger')
					</h5>
					<button type="button" class="close" data-dismiss="modal">
						&times;
					</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					@lang('product.areYouSureCancel',['orderCode'=>"<b class='text-primary'>".$order->code."</b>"])
				</div>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary w-50 mr-5" data-dismiss="modal">
						@lang('product.no')
					</button>
					<form action="{{ route('cancelOrder') }}" method="POST">
						@csrf
						<input name="order" type="hidden" value="{{$order->id}}">
						<button class="btn btn-danger w-50 mx-2 pr-5 pl-4">
							@lang('product.yes')
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endpush