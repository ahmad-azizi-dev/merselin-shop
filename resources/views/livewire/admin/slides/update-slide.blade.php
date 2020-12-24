<div>
	<!-- Modal body -->
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-6">
				<!-- text input -->
				<div class="form-group">
					<label for="title">Title</label>
					<input wire:model.lazy="title" class="form-control @error('title') is-invalid @enderror "
					       name="title" type="text">
					@error('title') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="button_name">Button name</label>
					<input wire:model.lazy="button_name"
					       class="form-control @error('button_name') is-invalid @enderror "
					       name="button_name" type="text">
					@error('button_name') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<!-- textarea -->
				<div class="form-group">
					<label for="content">Content</label>
					<textarea wire:model.lazy="content" class="form-control @error('content') is-invalid @enderror "
					          rows="3" name="content" cols="50">
					</textarea>
					@error('content') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="link">Link</label>
					<textarea wire:model.lazy="link" class="form-control @error('link') is-invalid @enderror "
					          rows="3" name="link" cols="50">
					</textarea>
					@error('link') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Priority</label>
					<select wire:model.lazy="priority" class="custom-select" name="Priority">
						<option value="0" class="text-danger">disable</option>
						@for ($i = 1; $i < 8; $i++)
							<option value="{{$i}}"> {{$i}} </option>
						@endfor
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<h6 class="mt-1 mx-1" style="font-size: 16px; font-weight: 700; margin-bottom: 9px">Image
					<span wire:target="img" wire:loading.class="spinner-grow spinner-grow-sm text-secondary"></span>
					<span wire:target="img" wire:loading.class="spinner-grow spinner-grow-sm text-secondary"></span>
				</h6>
				<div class="custom-file mb-3">
					<input wire:model.lazy="img" class="custom-file-input @error('img') is-invalid @enderror "
					       id="img" name="img" type="file">
					<label for="img" class="custom-file-label">
						@if ($img)
							{{$img->getClientOriginalName()}}
						@else
							Choose file
						@endif
					</label>
					@error('img') <span class="error text-danger ml-1 d-block">{{ $message }}</span> @enderror
				</div>
			</div>
		</div>
		<img width="100%" src="{{url('storage/slides/').'/'.$imgName}}">
	</div>
	<!-- Modal footer -->
	<div class="modal-footer">
		<button type="button" class="btn btn-block btn-secondary mr-3"
		        data-dismiss="modal" style="width: 35%">dismiss
		</button>
		<button wire:click="update" class="btn btn-block bg-gradient-warning m-2" style="width:35%">
			update
			<span wire:target="update" wire:loading.class="spinner-grow spinner-grow-sm text-white"></span>
		</button>
	</div>
	
	@if(Session::has('slideUpdated'))
		<div class="alert alert-default-success alert-dismissible mx-4">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> {{Session('slideUpdated')}}
		</div>
	@endif
</div>