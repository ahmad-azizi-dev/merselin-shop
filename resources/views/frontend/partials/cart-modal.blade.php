<div class="modal fade mt-5" id="removeFromCart{{$product->id}}">
	<div class="modal-dialog">
		<div class="modal-content cart">
			<div class="modal-footer flag">
				<button onClick="Livewire.emit('removeFromCart',{{ $product->id }})"
				        data-dismiss="modal"></button>
			</div>
		</div>
	</div>
</div>