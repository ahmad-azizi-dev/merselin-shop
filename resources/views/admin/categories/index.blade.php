@extends('admin.layout.master')

@section('head')
	<title>categories list</title>
	<link rel="stylesheet" href="{{asset('admin/css/toastr.css')}}">
@endsection

@section('main-content')
	
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">categories list</h1>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<span class="card-title"><i class="fa fa-list"></i></span>
				<div class="text-right">
					<a href="{{route('categories.create')}}" class="btn ntn-app text-primary">
						add new category<i class="fa fa-edit"></i>
					</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<table class="table table-sm table-striped table-responsive">
					<thead>
					<tr>
						<th style="min-width: 100px !important;">id</th>
						<th style="min-width: 250px !important;">name</th>
						<th style="min-width: 250px !important;">operations</th>
					</tr>
					</thead>
					<tbody>
					@foreach($categories as $category)
						<tr>
							<td>{{$category->id}}</td>
							<td>&#128309; {{$category->name}}</td>
							<td style="min-width: 230px !important;">
								<a class="btn btn-sm  bg-gradient-warning m-2"
								   href="{{route('categories.indexSetting', $category->id)}}">Setting
								</a>
								<button type="button" class="btn btn-sm  bg-gradient-info m-2" data-toggle="modal"
								        data-target="#details{{$category->id}}">details
								</button>
								<button type="button" class="btn btn-sm btn-danger m-2" data-toggle="modal"
								        data-target="#myModal{{$category->id}}">delete
								</button>
								
								@include('admin.categories.details-modal')
								@include('admin.categories.delete-modal',['currentPage'=>(($currentPage=$categories->currentPage())?$currentPage:url('/'))])
							</td>
						</tr>
						@if(count($category->childrenRecursive) > 0)
							@include('admin.partials.category_list', ['categories'=>$category->childrenRecursive, 'level'=>1])
						@endif
					@endforeach
					
					</tbody>
				</table>
			</div>
			
			<div class="card-footer clearfix">
				<div class="text-center">{{$categories->withQueryString()->links()}}</div>
				
				<div class="col-sm-6">
					{!! Form::open(['method' => 'get','route' => 'categories.index','class'=>'form-inline']) !!}
					<div class="form-group mb-2">
						
						{!! Form::select('PerPage', ['1' => '1 ','2' => '2 ','3' => '3','5' => '5','7' => '7','10' => '10','15' => '15','20' => '20','40' => '40'],
						Session('PerPageCategory'),['class' => 'form-control', 'data-toggle'=>'tooltip','title'=>'category per page','data-placement'=>'bottom']) !!}
						
						{!! Form::submit('show',['class' => 'btn btn-success m-1']) !!}
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	
	</div>

@endsection

@section('script')
	
	<script src="{{asset('admin/js/toastr.min.js')}}"></script>
	<script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
	</script>
	@if(Session::has('category'))
		@include('admin.partials.notification',['notification'=>Session('category'),'toastr'=>Session('toastr')])
	@endif

@endsection
