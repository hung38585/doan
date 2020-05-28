@extends('user.layout.main')
@section('title','About')
@section('content')
<!--MOBILE MENU START -->
<div id="sidr">
	<nav>
		<ul>
			<li>
				<a href="/">HOME</a>
			</li>
			<li>
				<a href="/products">Products</i></a>
			</li>
			<li>
				<a href="/about">About</a>
			</li>
			<li>
				<a href="/contact">Contact</a>
			</li>
			<li>
				<a href="{{route('products.index')}}?sale=sale">Sale</a>
			</li>
		</ul>						
	</nav>
</div>
<!--MOBILE MENU END -->
<!--MAIN MENU AREA  START-->
<div class="main_menu_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<!--DESKTOP MENU START -->
				<div class="mainmenu">
					<nav>
						<ul id="nav">
							<li>
								<a href="/">HOME </a>
							</li>
							<li>
								<a href="/products">Products</a>
							</li>
							<li>
								<a href="/about">About</a>
							</li>
							<li>
								<a href="/contact">Contact</a>
							</li>
							<li >
								<a href="{{route('products.index')}}?sale=sale">Sale</a>
							</li>
						</ul>						
					</nav>
				</div>
				<!--DESKTOP MENU END -->
			</div>
		</div>
	</div>
</div>
<!--MAIN MENU AREA  END-->
<!--BREADCRUMB AREA START -->
<div class="breadcrumb_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">	
				<div class="breadcrumb-row">
					<h3 class="breadcrumb"><a href="/" class="home">Home</a><span>/</span>About</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA END -->
@foreach($abouts as $key => $about)
<div class="container" style="margin-top: 10px;">
	<h3 class="font-weight-bold">Name: <span style="font-size: 20px;">{{$about->name}}</span></h3>
	<h3 class="font-weight-bold">Title: <span style="font-size: 20px;">{{$about->title}}</span></h3>
	<h3 class="font-weight-bold">Discription: <span style="font-size: 20px;">{!! $about->content !!}</span></h3>
	<h3 class="font-weight-bold">Address: <span style="font-size: 20px;">{{$about->address}}</span></h3>
	<h3 class="font-weight-bold">Contact: </h3>
	<p style="font-size: 20px;">Email: {{$about->email}}</p>
	<p style="font-size: 20px;">Phone: {{$about->phone}}</p>
</div>
<input type="hidden" value="{{$about->title}}" id="titlevalue">
<input type="hidden" value="{{$about->name}}" id="namevalue">
<input type="hidden" value="{{$about->address}}" id="addressvalue">
<input type="hidden" value="{{$about->email}}" id="emailvalue">
<input type="hidden" value="{{$about->phone}}" id="phonevalue">
<input type="hidden" value="{{asset('images/'.$about->logo)}}" id="logovalue">
@endforeach
<script src="{{asset('client/js/setabout.js')}}"></script>	
@endsection