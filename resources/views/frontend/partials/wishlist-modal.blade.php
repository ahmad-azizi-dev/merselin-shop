@push('modal')
	<div class="modal fade mt-5" id="removeFromWishlist{{$product->id}}">
		<div class="modal-dialog">
			<div class="modal-content wishlist">
				<div class="modal-footer">
					<button onClick="Livewire.emit('removeFromWishlist',{{ $product->id }})"
					        data-dismiss="modal"></button>
				</div>
			</div>
		</div>
	</div>
@endpush