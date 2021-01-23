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
								<th>Phone Number</th>
								<th>Name</th>
								<th>Email</th>
								<th>Password status</th>
								<th>Created at</th>
								<th>Updated at</th>
								<th style="min-width: 150px">update diff</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody class="position-relative">
							@foreach($users as $user)
								<tr>
									<td>0{{$user->phone_number }}</td>
									<td>{!! $user->name==='not_set'?"<b class='text-primary'>not set</b>":$user->name !!}</td>
									<td>{!! Str::startsWith($user->email,'not_set-')?"<b class='text-primary'>not set</b>":$user->email!!}</td>
									<td>{!! $user->password==='not_set'?"<b class='text-primary'>not set</b>":'hashed' !!}</td>
									<td> @if($user->created_at) {{$user->created_at->setTimezone('Asia/Tehran')}}  @endif </td>
									<td> @if($user->updated_at) {{$user->updated_at->setTimezone('Asia/Tehran')}}  @endif </td>
									<td> @if($user->updated_at) {{$user->updated_at->diffForHumans()}}  @endif </td>
									<td>
										<button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
										        data-target="#deleteUser{{$user->id}}">delete
										</button>
										@include('admin.users.delete-user-modal')
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
						{{ $users->links() }}
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="row">
								<span class=" align-self-center mr-3">Per Page : </span>
								<select wire:model="perPage" style="max-width:100px" class="form-control" >per page
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