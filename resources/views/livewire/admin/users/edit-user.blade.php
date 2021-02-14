<div>
	<!-- Modal body -->
	<div class="modal-body">
		<div class="row">
			<div class="col-sm-6">
				<!-- text input -->
				<div class="form-group">
					<label for="title">Phone Number</label>
					<input wire:model.lazy="phone_number"
					       class="form-control @error('phone_number') is-invalid @enderror "
					       name="title" type="text">
					@error('phone_number') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="button_name">Name</label>
					<input wire:model.lazy="name"
					       class="form-control @error('name') is-invalid @enderror "
					       name="button_name" type="text">
					@error('name') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<!-- text input -->
				<div class="form-group">
					<label for="title">Email</label>
					<input wire:model.lazy="email" class="form-control @error('email') is-invalid @enderror "
					       name="title" type="text">
					@error('email') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="button_name">Password</label>
					<input wire:model.lazy="password"
					       class="form-control @error('password') is-invalid @enderror "
					       name="button_name" type="text">
					@error('password') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="roles">Roles</label>
					<select wire:model.lazy="roles" class="form-control" multiple style="min-height:300px">
						@foreach($allRoles as $role)
							<option>{{$role->name}}</option>
						@endforeach
					</select>
					@error('roles') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
				</div>
			</div>
		</div>
	
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
	
	@if(Session::has('userUpdated'))
		<div class="alert alert-default-success alert-dismissible mx-4">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Success!</strong> {{Session('userUpdated')}}
		</div>
	@endif
</div>