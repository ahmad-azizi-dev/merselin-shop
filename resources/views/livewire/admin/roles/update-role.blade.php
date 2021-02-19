<div>
    <!-- Modal body -->
    <div class="modal-body">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="name">Name</label>
                <input wire:model.lazy="name" class="form-control @error('title') is-invalid @enderror "
                       placeholder="Enter a role name..." name="name" type="text">
                @error('name') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label for="permissions">Permissions</label>
                <select wire:model.lazy="permissions" class="form-control" multiple style="min-height:300px">
                    @include('admin.roles.permission-options')
                </select>
                @error('permissions') <span class="error text-danger ml-1">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-block btn-secondary mr-3"
                data-dismiss="modal" style="width: 35%">dismiss
        </button>
        <button wire:click="update" class="btn btn-block bg-gradient-warning m-2" style="width: 35%">
            update
            <span wire:target="update" wire:loading.class="spinner-grow spinner-grow-sm text-white"></span>
        </button>
    </div>

    @if(Session::has('roleUpdated'))
        <div class="alert alert-default-success alert-dismissible mx-4">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> {{Session('roleUpdated')}}
        </div>
    @endif
    
    @if(Session::has('accessDenied'))
        <div class="alert alert-default-danger alert-dismissible mx-4">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Access denied! </strong> {{Session('accessDenied')}}
        </div>
    @endif
</div>