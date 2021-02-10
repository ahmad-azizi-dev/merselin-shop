<div class="modal fade edit" id="editUser{{$user->id}}">
    <div class="modal-dialog modal-lg rtl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title text-warning"><i class="fa fa-edit"></i>
                    edit user</h5>
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
            </div>
            @livewire('admin.users.edit-user',[
            'userId'=>$user->id,
            'phone_number'=>$user->phone_number,
            'name'=>$user->name==='not_set'?null:$user->name,
            'email'=>Str::startsWith($user->email,'not_set-')?null:$user->email,
            'roles'=>$user->roles,
            ],key($user->id))
        </div>
    </div>
</div>