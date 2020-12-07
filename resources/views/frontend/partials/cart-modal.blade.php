@push('modal')
	<!-- The Cart Modal -->
	<div class="modal fade mt-5" id="removeFromCart{{$product->id}}">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-footer">
					<button onClick="Livewire.emit('removeFromCart',{{ $product->id }})"
					        data-dismiss="modal"></button>
				</div>
			</div>
		</div>
	</div>
@endpush