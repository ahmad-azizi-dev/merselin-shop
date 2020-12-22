<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<span class="card-title"><i class="fa fa-list"></i></span>
			<div class="text-right">
				<button type="button" class="btn btn-sm  bg-gradient-info m-2" data-toggle="modal"
				        data-target="#newSlide">
					add new slide <i class="fa fa-edit"></i>
				</button>
			</div>
			@include('admin.slides.add-new-slide-modal')
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table class="table table-sm table-striped table-responsive">
				<thead>
				<tr>
					<th style="min-width: 100px !important;">title</th>
					<th style="min-width: 250px !important;">content</th>
					<th style="min-width: 100px !important;">button name</th>
					<th style="min-width: 100px !important;">link</th>
					<th style="min-width: 100px !important;">image</th>
					<th style="min-width: 100px !important;">operations</th>
				</tr>
				</thead>
				<tbody>
				
				
				</tbody>
			</table>
		</div>
		
		<div class="card-footer clearfix">
			
			<div class="col-sm-6">
			
			</div>
		</div>
	</div>
</div>