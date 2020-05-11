@extends('user.layout.main')
@section('title','Clients Login')
@section('content')
<div class="container">
	<div class="row">
		<div class="client_login_form col-sm-5 col-sm-offset-4">
			<div class="card-body">
				<form method="POST" action="{{ url('/login') }}">
					<div class="card-header"><h2> Clients Login </h2></div>
					@csrf
					<div class="form-group">							
						<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="User name" name="username" value="{{ old('username') }}" required autofocus>

						@if ($errors->has('username'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('username') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required style="margin-bottom: 10px;">

						@if ($errors->has('password'))
						<span class="invalid-feedback text-danger" role="alert" >
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
						@if (Session::has('err'))
						<span class="invalid-feedback text-danger"><strong>{{ Session::get('err')}}</strong></span>
						@endif
					</div>
					<div class="form-group">							
						<button type="submit" class="btn btn-success btn-block">{{ __('Login') }}</button>
						<p class="text-center" style="margin-top: 10px;"><a href="{{ url('/register') }}" >Create a new account.</a></p> 
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@foreach($abouts as $key => $about)
<input type="hidden" value="{{$about->title}}" id="titlevalue">
<input type="hidden" value="{{$about->name}}" id="namevalue">
<input type="hidden" value="{{$about->address}}" id="addressvalue">
<input type="hidden" value="{{$about->email}}" id="emailvalue">
<input type="hidden" value="{{$about->phone}}" id="phonevalue">
<input type="hidden" value="{{asset('images/'.$about->logo)}}" id="logovalue">
@endforeach
@endsection