@extends('admin.layout.master')

@section('head')
	<title>add new category</title>
@endsection

@section('main-content')
	
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h3 class="m-0 text-dark">add new category</h3>
				</div>
			</div>
		</div>
	</div>
	
	@include('admin.partials.form-errors')
	
	<div class="col-md-12">
		
		<!-- general form elements disabled -->
		<div class="card card-warning">
			<div class="card-header">
				<h3 class="card-title"><i class="fa fa-edit"></i>
					Please enter the following inputs
				</h3>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				
				{!! Form::open(['method' => 'post','route' => 'categories.store','role' => 'form','files' => true]) !!}
				
				<div class="row">
					<div class="col-sm-6">
						<!-- text input -->
						<div class="form-group">
							{!! Form::label('name', 'name') !!}
							{!! Form::text('name',null, ['class' => 'form-control','placeholder' => 'Enter a name ...']) !!}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('slug', 'slug (optional)') !!}
							{!! Form::text('slug',null, ['class' => 'form-control','placeholder' => 'choose automatically by title if leave empty']) !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<!-- textarea -->
						<div class="form-group">
							{!! Form::label('meta_title', 'meta title') !!}
							{!! Form::textarea('meta_title',null, ['class' => 'form-control','placeholder' => 'Enter a meta title ...','rows' => '3']) !!}
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							{!! Form::label('meta_desc', 'meta description') !!}
							{!! Form::textarea('meta_desc',null, ['class' => 'form-control','placeholder' => 'Enter a meta description ...','rows' => '3']) !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<!-- textarea -->
						<div class="form-group">
							{!! Form::label('meta_keywords', 'meta keywords') !!}
							{!! Form::textarea('meta_keywords',null, ['class' => 'form-control','placeholder' => 'Enter a meta keywords ...','rows' => '3']) !!}
						</div>
					</div>
					<div class="col-sm-6">
						<h6 class="mt-1 mx-1">category icon</h6>
						<div class="custom-file">
							{!! Form::file('icon',['class' => 'custom-file-input','id' => 'icon']) !!}
							{!! Form::label('icon', 'Choose file',['class' => 'custom-file-label']) !!}
						</div>
						<h6 class="mt-3 mx-1">category image</h6>
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
								@foreach($categories as $category)
									<option value="{{$category->id}}">&#128309; {{$category->name}}</option>
									@if(count($category->childrenRecursive) > 0)
										@include('admin.partials.category', ['categories'=>$category->childrenRecursive, 'level'=>1])
									@endif
								@endforeach
							</select>
						
						</div>
					</div>
				</div>
				
				<div class="form-group">
					{!! Form::submit('submit',['class' => 'btn btn-lg bg-gradient-info']); !!}
				</div>
				{!! Form::close() !!}
			</div>
		
		</div>
	</div>

@endsection

@section('script')
	<!-- bs-custom-file-input -->
	<script src="{{asset('admin/js/bs-custom-file-input.min.js')}}"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
	</script>
@endsection