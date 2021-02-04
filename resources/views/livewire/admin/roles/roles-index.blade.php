<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="bg-white p-3">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped" style="min-width: 600px">
                            <thead>
                            <tr>
                                <b></b>
                                <th>Name</th>
                                <th style="min-width: 200px">Permissions</th>
                                <th>Created at</th>
                                <th style="min-width: 150px">Updated diff</th>
                                <th style="min-width: 150px">Action</th>
                            </tr>
                            </thead>
                            <tbody class="position-relative">
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        <ul>
                                            @foreach($role->permissions as $permission)
                                                <li>{{$permission->name}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td> @if($role->created_at) {{$role->created_at->setTimezone('Asia/Tehran')}}  @endif </td>
                                    <td> @if($role->updated_at) {{$role->updated_at->diffForHumans()}}  @endif </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning m-2 px-3" data-toggle="modal"
                                                data-target="#editRole{{$role->id}}">edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
                                                data-target="#deleteRole{{$role->id}}">delete
                                        </button>
                                        @include('admin.roles.delete-role-modal')
                                        @include('admin.roles.edit-role-modal')
                                    </td>
                                </tr>
                            @endforeach
                            <div wire:target="destroy,perPage" wire:loading class="bg-dark position-absolute  rounded"
                                 style="display:none;min-height: calc(100% - 3rem);min-width: calc(100% - 2rem);opacity: 0.5;z-index: 1000"
                                 wire:loading>
                            </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        {{ $roles->links() }}
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="row">
                                <span class=" align-self-center mr-3">Per Page : </span>
                                <select wire:model="perPage" style="max-width:100px" class="form-control">per page
                                    <option>5</option>
                                    <option>10</option>
                                    <option>15</option>
                                    <option>30</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>