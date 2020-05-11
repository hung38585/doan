@extends('admin.layout.app')
@section('title','Login')
@section('content')
<div class="container">
	<div class="row">
		<div class="admin_login_form col-sm-5 col-sm-offset-4">
			<div class="card-body">
				<form method="POST" action="{{ url('/admin/login') }}">
					<div class="card-header"><h2 class="text-center"> ADMIN LOGIN </h2></div>
					@csrf
					<div class="form-group">							
						<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username" name="username" value="{{ old('username') }}" required autofocus>

						@if ($errors->has('username'))
						<span class="invalid-feedback " role="alert">
							<strong>{{ $errors->first('username') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required>

						@if ($errors->has('password'))
						<span class="invalid-feedback text-danger" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
						@if (Session::has('err'))
						<span class="invalid-feedback text-danger"><strong>{{ Session::get('err')}}</strong></span>
						@endif
					</div>
					<div class="form-group">							
						<button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection