@extends('user.layout.main')
@section('title','Profile')
@section('content')
<!--BREADCRUMB AREA START -->
<div class="breadcrumb_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">	
				<div class="breadcrumb-row">
					<h3 class="breadcrumb"><a href="/" class="home">Home</a><span>/</span>Profile</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA END -->
<div class="container">
	<div class="row">
		<!-- Khu vuc thong tin khach hang -->
		<div class="col-xs-12 col-sm-3 info_user">
			<div class="info_user_inner">
				<h2 class="text-center line_green_center">Profile</h2>
				<h4>First name</h4>
				<h6>{{ Auth::guard('client')->user()->first_name }}</h6>
				<hr>	
				<h4>Last name</h4>
				<h6 >{{ Auth::guard('client')->user()->last_name }}</h6>
				<hr>
				<h4>Address</h4>
				<h6 >{{ Auth::guard('client')->user()->address }}</h6>
				<hr>
				<h4>Phone </h4>
				<h6 >{{ Auth::guard('client')->user()->phone }}</h6>
				<hr>
				<h4>Email </h4>
				<h6>{{ Auth::guard('client')->user()->email }}</h6>
			</div>			
				<div class="text-center">
					<a href="{{route('profile.edit',Auth::guard('client')->user()->username)}}" class="btn btn-success">Edit Profile</a>
				</div>
		</div>
		<!-- Khu vuc thanh toan -->
		<div class="col-xs-12 col-sm-9">
			<!-- Thanh Header trang thai -->
			
			<!-- Khu vuc hien thi -->

		</div>
	</div>
</div>
@endsection