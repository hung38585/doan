@extends('user.layout.main')
@section('title','Contact')
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
					<h3 class="breadcrumb"><a href="/" class="home">Home</a><span>/</span>Contact</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA END -->
<!-- contact-area start -->
<div class="contact-area">
	<div class="container">
		<div class="row">
			<!-- contact-info start -->
			<div class="col-md-6 col-sm-12 col-xs-12 left-con">
				<div class="contact-info">
					<h3>Contact info</h3>
					<ul>
						<li>
							<i class="fa fa-map-marker"></i> <strong>Address:</strong>
							{{$abouts[0]->address}}
						</li>
						<li>
							<i class="fa fa-mobile"></i> <strong>Phone:</strong>
							{{$abouts[0]->phone}}
						</li>
						<li>
							<i class="fa fa-envelope"></i> <strong>Email:</strong>
							{{$abouts[0]->email}}
						</li>
					</ul>
				</div>
			</div>
			<!-- contact-info end -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="contact-form">
					<h3><i class="fa fa-envelope-o"></i> Leave a Message</h3>
					<div class="row">
						<form action="{{ url('/sendcontact') }}" method="POST">
							@csrf
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="name" type="text" placeholder="Name (required)" />
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="email" type="email" placeholder="Email (required)" />
							</div> 
							<div class="col-md-12 col-sm-12 col-xs-12">
								<textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
								<input type="submit" value="Send contact" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- contact-area end -->
@foreach($abouts as $key => $about)
<input type="hidden" value="{{$about->title}}" id="titlevalue">
<input type="hidden" value="{{$about->name}}" id="namevalue">
<input type="hidden" value="{{$about->address}}" id="addressvalue">
<input type="hidden" value="{{$about->email}}" id="emailvalue">
<input type="hidden" value="{{$about->phone}}" id="phonevalue">
<input type="hidden" value="{{asset('images/'.$about->logo)}}" id="logovalue">
@endforeach
<script src="{{asset('client/js/setabout.js')}}"></script>	
@endsection