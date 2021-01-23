@extends('admin.layout.master')

@section('head')
	<title>Login By Phone Token</title>
	@livewireScripts
@endsection

@section('main-content')
	
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0 text-dark">Login Phone Token List</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="card">
			@livewire('admin.login-by-phone-token.login-by-phone-token-index')
		</div>
	</div>
@endsection

@section('script')
	@livewireScripts
@endsection
