<div>
	<!-- Modal body -->
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-6">
				<!-- text input -->
				<div class="form-group">
					<label for="title">Title</label>
					<input wire:model.defer="title" class="form-control" placeholder="Enter a title..."
					       name="title" type="text">
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="button_name">Button name</label>
					<input wire:model.defer="button_name" class="form-control" placeholder="Enter a button name..."
					       name="button_name" type="text" id="slug">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<!-- textarea -->
				<div class="form-group">
					<label for="content">Content</label>
					<textarea wire:model.defer="content" class="form-control" placeholder="Enter a content..."
					          rows="3" name="content" cols="50">
					</textarea>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="link">Link</label>
					<textarea wire:model.defer="link" class="form-control" placeholder="Enter a link..."
					          rows="3" name="link" cols="50">
					</textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Priority</label>
					<select wire:model.defer="Priority" class="custom-select" name="Priority">
						<option value="0" class="text-danger">disable</option>
						@for ($i = 1; $i < 8; $i++)
							<option value="{{$i}}"> {{$i}} </option>
						@endfor
					</select>
				</div>
			</div>
			@if ($img)
				Photo Preview:
				<img src="{{ $img->temporaryUrl() }}">
			@endif
			<div class="col-sm-6">
				<h6 class="mt-1 mx-1" style="font-size: 16px; font-weight: 700; margin-bottom: 9px">Image</h6>
				<div class="custom-file">
					<input wire:model.defer="img" class="custom-file-input" id="img" name="img" type="file">
					<label for="img" class="custom-file-label">Choose file</label>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-block btn-secondary w-25 mr-3"
		        data-dismiss="modal">dismiss
		</button>
		<button wire:click="store" class="btn btn-block bg-gradient-warning m-2 w-25">
			submit
		</button>
	</div>
</div>