<div class="card-body">
	<table class="table table-sm table-striped table-responsive">
		<thead>
		<tr>
			<th style="min-width: 100px">title</th>
			<th style="min-width: 250px">content</th>
			<th style="min-width: 120px">button name</th>
			<th style="min-width: 150px">link</th>
			<th>image</th>
			<th style="min-width: 100px">priority</th>
			<th style="min-width: 150px">operations</th>
			<th style="min-width: 170px">created date (Teh)</th>
			<th style="min-width: 170px">updated date (Teh)</th>
			<th style="min-width: 150px">update diff</th>
		</tr>
		</thead>
		<tbody>
		@foreach($slides as $slide)
			<tr>
				<td>{{$slide->title}}</td>
				<td>{{$slide->content}}</td>
				<td>{{$slide->button_name}}</td>
				<td>{{$slide->link}}</td>
				<td><img width="150px" src="{{url('storage/slides/').'/'.$slide->img}}"></td>
				<td class="text-center">{{($slide->priority===0?'❌disabled':$slide->priority)}}</td>
				<td>
					<button type="button" class="btn btn-sm  bg-gradient-warning m-2" data-toggle="modal"
					        data-target="#editSlide{{$slide->id}}">edit
					</button>
					<button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
					        data-target="#deleteSlide{{$slide->id}}">delete
					</button>
				</td>
				<td> @if($slide->created_at) {{$slide->created_at->setTimezone('Asia/Tehran')}}  @endif </td>
				<td> @if($slide->updated_at) {{$slide->updated_at->setTimezone('Asia/Tehran')}}  @endif </td>
				<td> @if($slide->updated_at) {{$slide->updated_at->diffForHumans()}}  @endif </td>
			</tr>
			@include('admin.slides.edit-slide-modal')
			@include('admin.slides.delete-slide-modal')
		
		@endforeach
		
		</tbody>
	</table>
</div>