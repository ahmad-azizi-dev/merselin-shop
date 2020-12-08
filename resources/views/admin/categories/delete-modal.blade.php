<div class="modal fade" id="myModal{{$category->id}}">
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
				are you sure that want to delete the
				<b class="text-info">{{$category->name}} </b>
				category!!
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-block btn-secondary w-50 mr-3" data-dismiss="modal">
					cancel
				</button>
				{!! Form::open(['method' => 'DELETE', 'route' => ['categories.destroy', $category->id] ]) !!}
				{!! Form::hidden('currentPage', $currentPage) !!}
				{!! Form::submit('delete', ['class'=>'btn bg-gradient-danger mx-2']) !!}
				{!! Form::close() !!}
			
			</div>
		</div>
	</div>
</div>