@extends('admin.layout.master')

@section('head')
	<title>user profile</title>
@endsection

@section('main-content')
	
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-dark">user profile</h4>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			<iframe src="{{ route('profile.show') }}" style="border:none; height:700px"></iframe>
		</div>
	</div>
@endsection
