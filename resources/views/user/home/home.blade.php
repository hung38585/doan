@extends('user.layout.main')
@section('title','Home')
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
				<a href="">About</a>
			</li>

			<li>
				<a href="">Contact</a>
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
								<a href="/">HOME</a>
							</li>
							<li>
								<a href="/products">Products</i></a>
							</li>
							<li>
								<a href="">About</a>
							</li>
							<li>
								<a href="">Contact</a>
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
<!-- RIGHT SIDEBAR MENU AREA START -->
<div class="right_sidebar_menu_area">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
				<div class="right_sidebar_menu">
					<div class="right_menu_title">
						<h1 class="widgettitle"> <i class="fa fa-bars"></i> <span>CATEGORIES</span>  </h1>
					</div>
					<div class="r_menu" style="overflow-x: auto; height: 450px;">
						<ul>
							@foreach($categories as $key => $category)
								<li><a href="{{route('products.index')}}?category={{$category->name}}">{{ $category->name }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 middle-slider index3_sliderrow ">
				<!-- home slider start -->
				<div class="slider-container">
					<!-- Slider Image -->
					<div class="mainSlider nivoSlider slider-image" style="height: 500px;">
						@foreach($slides as $key => $slide)
							<img src="{{asset('images/'.$slide->url_img)}}" alt="main slider" title="#htmlcaption111" />
						@endforeach
					</div>
					<!-- Slider Caption 1 -->
					<div id="htmlcaption111" class="nivo-html-caption slider-caption-1">
						<div class="slider-progress"></div>
						<div class="slide1-text">
							<div class="middle-text mdd-slide">
								<div class="cap-dec wow bounceInDown" data-wow-duration="0.9s" data-wow-delay="0s">
									<h2 class="cap-3-h">Latest collection 2016</h2>
								</div>
								<div class="cap-title wow bounceInRight" data-wow-duration="1.2s" data-wow-delay="0.2s">
									<h3 class="cap-3-h-2">Best Smartphone</h3>
								</div>
								<div class="cap-readmore wow bounceInUp" data-wow-duration="1.3s" data-wow-delay=".5s">
									<a href="#">shop now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- home slider end -->
			</div>
		</div>
	</div>
</div>
<!-- RIGHT SIDEBAR MENU AREA END -->
<!--TAB COLLECTION AREA  START -->
<div class="tab_collection_area">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<h2>Sale</h2>
				<div class='panel-container row'>
					<!-- first_collection -->
					<div id="women">	
						<div class = 'short-width-slider'>
							<div class = 'slider1'>
								@foreach($product_promotions as $key => $product)
								<div class="col-xs-12">
									<div class="single_item">
										<!-- product Item -->
										<a href="{{route('products.show',$product->slug)}}">
											<div class = 'item'>
												<div class="product_img">
													<img src="{{asset('images/'.$product->image)}}" alt="" style="height: 200px;" />
												</div>
											</div>
										</a>
										<!-- product info -->
										<div class="info ">
											<p class="name"><a href="{{route('products.show',$product->id)}}">{{ $product->name }}</a></p>
											<div  class="star-rating two_star ">
												<span style="width:80%"><strong class="rating"> </strong> </span>
											</div>
											<del><span class="amount nrb">{{ $product->price }}đ</span></del>
											<span class="price"><span class="amount">{{ $product->price - intval(($product->price * $product->promotion)/100) }}đ</span></span>
										</div>
										<div class="inner">
											<div class="inner-text">Sale!</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					<!-- second_collection -->

					<!-- theree_collection -->

				</div>

			</div>
		</div>
	</div>
</div>
<div class="our_brand_area">
	<div class="container-fluid">
		<div class="section_title">
			<h2>OUR BRANDS</h2>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 ">
				<div class="brand">
					<!-- SINGLE BRAND -->
					<div class="brand_item">
						<div class="band_single">
							<a href="#">
								<img src="{{asset('client/img/brand/1.jpg')}}" alt="" />
							</a>
						</div>
						<div class="band_single">
							<a href="#">
								<img src="{{asset('client/img/brand/1.jpg')}}" alt="" />
							</a>
						</div>
						<div class="band_single">
							<a href="#">
								<img src="{{asset('client/img/brand/1.jpg')}}" alt="" />
							</a>
						</div>
						<div class="band_single">
							<a href="#">
								<img src="{{asset('client/img/brand/1.jpg')}}" alt="" />
							</a>
						</div>
						<div class="band_single">
							<a href="#">
								<img src="{{asset('client/img/brand/1.jpg')}}" alt="" />
							</a>
						</div>
						<div class="band_single">
							<a href="#">
								<img src="{{asset('client/img/brand/1.jpg')}}" alt="" />
							</a>
						</div>
						<div class="band_single">
							<a href="#">
								<img src="{{asset('client/img/brand/1.jpg')}}" alt="" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>		
</div>
<!--OUR BRANDS AREA AREA END -->
@foreach($abouts as $key => $about)
<input type="hidden" value="{{$about->title}}" id="titlevalue">
<input type="hidden" value="{{$about->name}}" id="namevalue">
<input type="hidden" value="{{$about->address}}" id="addressvalue">
<input type="hidden" value="{{$about->email}}" id="emailvalue">
<input type="hidden" value="{{$about->phone}}" id="phonevalue">
<input type="hidden" value="{{asset('images/'.$about->logo)}}" id="logovalue">
@endforeach
@endsection