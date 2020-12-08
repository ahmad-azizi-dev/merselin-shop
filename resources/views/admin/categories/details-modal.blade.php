<div class="modal fade" id="details{{$category->id}}">
	<div class="modal-dialog modal-lg">
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
				<table class="table-bordered table-sm table-striped table-responsive">
					<tbody>
					<tr>
						<th style="min-width: 180px !important;">id</th>
						<td style="min-width: 580px !important;">{{$category->id}}</td>
					</tr>
					<tr>
						<th>name</th>
						<td>{{$category->name}}</td>
					</tr>
					<tr>
						<th>icon</th>
						<td>
							<img src="{{url('/').'/storage/categories/'.$category->icon}}"
							     width="50px" alt="not found">
						</td>
					</tr>
					<tr>
						<th>image</th>
						<td>
							<img src="{{url('/').'/storage/categories/'.$category->image}}"
							     width="300px" alt="not found">
						</td>
					</tr>
					<tr>
						<th>meta title</th>
						<td>{{$category->meta_title}}</td>
					</tr>
					<tr>
						<th>slug</th>
						<td>{{$category->slug}}</td>
					</tr>
					<tr>
						<th>meta description</th>
						<td>{{$category->meta_desc}}</td>
					</tr>
					<tr>
						<th>meta keywords</th>
						<td>{{$category->meta_keywords}}</td>
					</tr>
					<tr>
						<th>parent ID</th>
						<td>{{$category->parent_id}}</td>
					</tr>
					<tr>
						<th>attributes</th>
						<td>
							<ul>
								@foreach($category->attributeGroups as $attributeGroup)
									<li>  {{$attributeGroup->title}}</li>
								@endforeach
							</ul>
						</td>
					</tr>
					<tr>
						<th>created date (Tehran)</th>
						<td>{{$category->created_at->setTimezone('Asia/Tehran')}}</td>
					</tr>
					<tr>
						<th>updated date (Tehran)</th>
						<td>{{$category->updated_at->setTimezone('Asia/Tehran')}}</td>
					</tr>
					</tbody>
				</table>
			
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-block btn-secondary w-25 mr-3"
				        data-dismiss="modal">Ok
				</button>
				<a class="btn btn-block  bg-gradient-warning m-2 w-25"
				   href="{{route('categories.edit', $category->id)}}">edit
				</a>
			</div>
		</div>
	</div>
</div>