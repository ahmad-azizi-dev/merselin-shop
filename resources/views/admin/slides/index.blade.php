@extends('admin.layout.master')

@section('head')
	<title>slides list</title>
	<link rel="stylesheet" href="{{asset('admin/css/toastr.css')}}">
@endsection

@section('main-content')
	
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">slides list</h1>
				</div>
			</div>
		</div>
	</div>
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
			@livewire('admin.slides.slides-index')
			<div class="card-footer clearfix">
				
				<div class="col-sm-6">
				
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	@livewireScripts
	<!-- bs-custom-file-input -->
	<script src="{{asset('admin/js/bs-custom-file-input.min.js')}}"></script>
	<script type="text/javascript">
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
	</script>
@endsection
