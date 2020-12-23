<div class="content">
    <div class="row">

        <!-- /.card-header -->
        <div class="col-12">
            <div class="bg-white p-3">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped" style="min-width: 600px">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Phone Number</th>
                                    <th>Token</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="position-relative">
                                @foreach($tokens as $token)
                                    <tr>
                                        <td>{{$token->id}}</td>
                                        <td>{{$token->phone_number }}</td>
                                        <td>{{$token->token }}</td>
                                        <td>{{$token->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal" data-target="#myModal{{$token->id}}">delete</button>
                                            @include('admin.login-by-phone-token.delete-modal')
                                        </td>
                                    </tr>
                                @endforeach
                                <div wire:target="destroy" wire:loading class="bg-dark position-absolute  rounded"
                                     style="display:none;min-height: calc(100% - 3rem);min-width: calc(100% - 2rem);opacity: 0.5;z-index: 1000"
                                     wire:loading>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        {{ $tokens->links() }}
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="row">
                                <span class=" align-self-center mr-3">Per Page : </span>
                                <select wire:model="perPage" class="form-control w-25">per page
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

</div>
