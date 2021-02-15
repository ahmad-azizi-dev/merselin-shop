<div class="modal fade" id="deleteUser{{$user->id}}">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title text-danger"><i class="fa fa-window-close"></i>
					danger!</h4>
				<button type="button" class="close" data-dismiss="modal">&times;
				</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				are you sure you want to delete the user?
				<ul>
					<li>phone number:
						<b class="text-info">
							0{!! $user->phone_number>9999999999 ?"<b class='text-primary'> ---</b>":$user->phone_number!!}
						</b></li>
					<li>email:
						<b class="text-info">
							{!! Str::startsWith($user->email,'not_set-')?"<b class='text-primary'>not set</b>":$user->email!!}
						</b>
					</li>
				</ul>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-block btn-secondary w-50 mr-3" data-dismiss="modal">
					cancel
				</button>
				<button wire:click="deleteUser({{$user->id}})" class="btn btn-block bg-gradient-danger m-2"
				        style="width:35%" data-dismiss="modal">delete
				</button>
			</div>
		</div>
	</div>
</div>