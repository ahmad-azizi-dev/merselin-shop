@foreach($categories as $category)
	<tr>
		<td>{{$category->id}}</td>
		<td>
			@for ($i= $level ; $i >0 ; $i--)
				&#9562;
				&#9552;
				&#9552;
				&#128308;
			@endfor
			{{$category->name}}
		</td>
		<td style="min-width: 230px !important;">
			<a class="btn btn-sm  bg-gradient-warning m-2" href="{{route('categories.indexSetting', $category->id)}}">
				Setting
			</a>
			<button type="button" class="btn btn-sm  bg-gradient-info m-2" data-toggle="modal"
			        data-target="#details{{$category->id}}">details
			</button>
			<button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
			        data-target="#myModal{{$category->id}}">delete
			</button>
			
			@include('admin.categories.details-modal')
			@include('admin.categories.delete-modal')
		</td>
	</tr>
	@if(count($category->childrenRecursive) > 0)
		@include('admin.partials.category_list', ['categories' => $category->childrenRecursive, 'level' => $level+1])
	@endif
@endforeach
