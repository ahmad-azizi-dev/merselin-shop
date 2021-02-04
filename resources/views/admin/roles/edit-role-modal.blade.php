<div class="modal fade edit" id="editRole{{$role->id}}">
    <div class="modal-dialog modal-lg rtl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title text-info"><i class="fa fa-edit"></i>
                    edit role</h5>
                <button type="button" class="close" data-dismiss="modal">&times;
                </button>
            </div>
            @livewire('admin.roles.update-role',[
            'roleId'=>$role->id,
            'name'=>$role->name,
            'permissions'=>$role->permissions->pluck('name'),
            ],key($role->id))
        </div>
    </div>
</div>