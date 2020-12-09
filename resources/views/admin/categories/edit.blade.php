@extends('admin.layout.master')

@section('head')
	<title>update category</title>
@endsection

@section('main-content')
	
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3 class="m-0 text-dark">update category</h3>
				</div>
			</div>
		</div>
	</div>
	
	@include('admin.partials.form-errors')
	
	<div class="col-md-12">
		<div class="card card-warning">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-edit"></i>
					You can edit the following phrase in the <b>{{$category->name}}</b> category
				</h3>
			</div>
			
			<div class="card-body">
				{!! Form::model($category ,['method' => 'PATCH','files' => true,'route' => ['categories.update', $category->id],'role' => 'form']) !!}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('name', 'name') !!}
							{!! Form::text('name',null, ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('slug', 'slug (optional)') !!}
							{!! Form::text('slug',null, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('meta_title', 'meta title') !!}
							{!! Form::textarea('meta_title',null, ['class' => 'form-control','rows' => '3']) !!}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('meta_desc', 'meta description') !!}
							{!! Form::textarea('meta_desc',null, ['class' => 'form-control','rows' => '3']) !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('meta_keywords', 'meta keywords') !!}
							{!! Form::textarea('meta_keywords',null, ['class' => 'form-control','rows' => '3']) !!}
						</div>
					</div>
					<div class="col-sm-6">
						<h6 class="mt-1 mx-1">category icon</h6>
						<img src="{{url('/').'/storage/categories/'.$category->icon}}"
						     width="50px" alt="not found" class="ml-2 mb-2">
						<div class="custom-file">
							{!! Form::file('icon',['class' => 'custom-file-input','id' => 'icon']) !!}
							{!! Form::label('icon', 'Choose file',['class' => 'custom-file-label']) !!}
						</div>
						<h6 class="mt-3 mx-1">category image</h6>
						<img src="{{url('/').'/storage/categories/'.$category->image}}"
						     width="300px" alt="not found" class="ml-2 mb-2">
						<div class="custom-file">
							{!! Form::file('image',['class' => 'custom-file-input','id' => 'image']) !!}
							{!! Form::label('image', 'Choose file',['class' => 'custom-file-label']) !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<!-- select -->
						<div class="form-group">
							{!! Form::label('parent_id', ' parent for this category') !!}
							
							<select name="parent_id" id="" class="form-control">
								<option class="text-danger" value="0">no parent &#10060;</option>
								@foreach($categories as $category_data)
									
									{{--not choose its own or its children as parents, these IDs are restricted --}}
									@if($category->id !== $category_data->id)
										<option value="{{$category_data->id}}"
										        @if($category->parent_id === $category_data->id) class="text-primary" selected @endif>
											{{$category_data->name}}
										</option>
										@if(count($category_data->childrenRecursive) > 0)
											@include('admin.partials.category', ['categories'=>$category_data->childrenRecursive,
													 'level'=>1, 'selected_category'=>$category])
										@endif
									@endif
								@endforeach
							</select>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					{{--return back to the correct page number after updating--}}
					{!! Form::hidden('redirects_to', URL::previous()) !!}
					{!! Form::submit('update',['class' => 'btn btn-lg bg-gradient-info']); !!}
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection
