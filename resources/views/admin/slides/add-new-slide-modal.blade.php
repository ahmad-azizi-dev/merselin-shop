<div class="modal fade" id="newSlide">
	<div class="modal-dialog modal-lg rtl">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title text-info"><i class="fa fa-newspaper"></i>
					details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;
				</button>
			</div>
			<!-- Modal body -->
			<div class="modal-body">
				
				<div class="row">
					<div class="col-sm-6">
						<!-- text input -->
						<div class="form-group">
							<label for="name">title</label>
							<input class="form-control" placeholder="Enter a name ..." name="title" type="text">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="slug">button name</label>
							<input class="form-control" placeholder="choose automatically by title if leave empty"
							       name="button_name" type="text" id="slug">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<!-- textarea -->
						<div class="form-group">
							<label for="meta_title">content</label>
							<textarea class="form-control" placeholder="Enter a meta title ..." rows="3"
							          name="content" cols="50"></textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="meta_desc">link</label>
							<textarea class="form-control" placeholder="Enter a meta description ..." rows="3"
							          name="link" cols="50"></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Priority</label>
							<select class="custom-select">
								<option value="0" class="text-danger">disable</option>
								@for ($i = 1; $i < 8; $i++)
									<option value="{{$i}}"> {{$i}} </option>
								@endfor
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<h6 class="mt-1 mx-1" style="font-size: 16px; font-weight: 700; margin-bottom: 9px">image</h6>
						<div class="custom-file">
							<input class="custom-file-input" id="img" name="img" type="file">
							<label for="img" class="custom-file-label">Choose file</label>
						</div>
					</div>
				</div>
			
			
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-block btn-secondary w-25 mr-3"
				        data-dismiss="modal">Ok
				</button>
				<a class="btn btn-block  bg-gradient-warning m-2 w-25"
				>edit
				</a>
			</div>
		</div>
	</div>
</div>