@extends('user.layout.main')
@section('title','Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="card">
                <div class="row card-header line_green"><h2>Register</h2></div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/register') }}">
                        @csrf
                        <div class="form-group row">                            
                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First name" autofocus>
                            <strong class="text-danger">{{ $errors->first('first_name')}}</strong> 
                        </div>
                        <div class="form-group row">                            
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last name" autofocus>
                            <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                        </div>
                        <div class="form-group row">                            
                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Address" autofocus>
                            <strong class="text-danger">{{ $errors->first('address') }}</strong>
                        </div>
                        <div class="form-group row">                            
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Phone"  autofocus>
                            <strong class="text-danger">{{ $errors->first('phone') }}</strong>
                        </div>
                        <div class="form-group row">                            
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="User name"  autofocus>
                            <strong class="text-danger">{{ $errors->first('username') }}</strong>
                        </div>
                        <div class="form-group row">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        </div>
                        <div class="form-group row">                            
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" >
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        </div>
                        <div class="form-group row">                          
                            <input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="Confirm password" >
                            <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                        </div>
                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-success">
                                {{ __('Register') }}
                            </button>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection