<div class="modal fade" id="deleteRole{{$role->id}}">
    <div class="modal-dialog modal-sm">
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
                are you sure you want to delete the
                <b class="text-info">{{$role->name}} </b>
                role ?
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-secondary w-50 mr-3" data-dismiss="modal">
                    cancel
                </button>
                <button wire:click="deleteRole({{$role->id}})" class="btn btn-block bg-gradient-danger m-2"
                        style="width:35%" data-dismiss="modal">delete
                </button>
            </div>
        </div>
    </div>
</div>