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
	
	@livewire('admin.slides.slides-index')

@endsection

@section('script')
	@livewireScripts

@endsection
