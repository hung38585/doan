@extends('user.layout.main')
@section('title','Products')
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
								<a href="/">HOME </a>
							</li>
							<li>
								<a href="/products">Products</a>
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
<!--BREADCRUMB AREA START -->
<div class="breadcrumb_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">	
				<div class="breadcrumb-row">
					<h3 class="breadcrumb"><a href="/" class="home">Home</a><span>/</span>Products</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA END -->
<!-- banner slider start -->
<div class="add-slider-area banner-slider-area">
	<div class="slider-container">
		<!-- Slider Image -->
		<div class="mainSlider nivoSlider slider-image">
			<img src="{{asset('client/img/slider/16.jpg')}}" alt="main slider" title="#htmlcaption1" />
			<img src="{{asset('client/img/slider/17.jpg')}}" alt="main slider" title="#htmlcaption2" />
		</div>
		<!-- Slider Caption 1 -->
		<div id="htmlcaption1" class="nivo-html-caption slider-caption-1">
			<div class="slider-progress"></div>
			<div class="slide1-text text-2">
				<div class="middle-text">
					<div class="cap-dec wow bounceInDown" data-wow-duration="0.9s" data-wow-delay="0s">
						<h1>New Fashions</h1>
					</div>
					<div class="cap-title wow bounceInRight" data-wow-duration="1.2s" data-wow-delay="0.2s">
						<h2>Shoes & Bags</h2>
					</div>
					<div class="cap-readmore wow bounceInUp" data-wow-duration="1.3s" data-wow-delay=".5s">
						<a href="#">shop now</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Slider Caption 2 -->
		<div id="htmlcaption2" class="nivo-html-caption slider-caption-2">
			<div class="slider-progress"></div>
			<div class="slide1-text text-3">
				<div class="middle-text">
					<div class="cap-dec wow bounceIn" data-wow-duration="0.7s" data-wow-delay="0s">
						<h3>New Collection</h3>
					</div>
					<div class="cap-title wow bounceInLeft" data-wow-duration="1s" data-wow-delay="0.2s">
						<h1>Fashionable Watch</h1>
					</div>
					<div class="cap-readmore wow bounceIn" data-wow-duration="1.1s" data-wow-delay=".5s">
						<a href="#">shop now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- banner slider end -->
@if(session('success'))
<div class="alert alert-success text-center" >
	{{ session('success') }}
</div>
@endif
<!--PRODUCT CATEGORY START -->
<div class="blog_right_sidebar_area product_category">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 ">
				<!--product category left sidebar -->
				<div class="blog_right_sidebar_right_area">
					<!-- single widget -->
					<form action="" method="GET">
						<div class="info_widget">
							<div class="section_title">
								<h2>CATEGORIES</h2>
							</div>
							<ul class="product-categories">
								@foreach($categories as $key => $category)
								<li class="col-md-12">
									<input type="radio" name="category" id="cate{{$key}}" value="{{$category->slug}}" class="col-md-1" style="margin-top: 7px;">
									<label for="cate{{$key}}" class="col-md-9">{{ $category->slug }}</label>
									<span class="count col-md-2">({{ $listquantity[$key] }})</span>
								</li>
								@endforeach
							</ul>
						</div>
						<!-- single widget -->
						<div class="info_widget">
							<div class="section_title">
								<h2>Filter by Price</h2>
							</div>
							<ul class="product-categories">
								<li class="col-md-12">
									<input type="radio" name="price" id="price1" class="col-md-1" value="<?php echo htmlspecialchars('<1000000'); ?>" style="margin-top: 7px;">
									<label for="price1" class="col-md-9"><1000000</label>
								</li>
								<li class="col-md-12">
									<input type="radio" name="price" id="price2" class="col-md-1" value="1000000-2000000" style="margin-top: 7px;">
									<label for="price2" class="col-md-9">1000000-2000000</label>
								</li>
								<li class="col-md-12">
									<input type="radio" name="price" id="price3" class="col-md-1" value="2000000-5000000" style="margin-top: 7px;">
									<label for="price3" class="col-md-9">2000000-5000000</label>
								</li>
								<li class="col-md-12">
									<input type="radio" name="price" id="price4" class="col-md-1" value=">5000000" style="margin-top: 7px;">
									<label for="price4" class="col-md-9">>5000000</label>
								</li> 
							</ul>
						</div>
						<!-- single widget -->
						<div class="info_widget">
							<div class="section_title">
								<h2>Filter by color</h2>
							</div>
							<ul class="product-categories">
								@foreach($listcolorquantity as $key => $value)
								<li class="col-md-12">
									<input type="radio" name="color" id="{{$key}}" class="cate col-md-1" value="{{$key}}" style="margin-top: 7px;">
									<label for="{{$key}}" class="col-md-9"><?php echo ucwords($key); ?></label>
									<span class="count col-md-1">({{$value}})</span>
								</li>
								@endforeach 
							</ul>
						</div>
						<input type="hidden" value="{{ isset($_GET['productname']) ? $_GET['productname']: ''}}" name="productname" id="productname">
						<input type="hidden" value="{{ isset($_GET['orderby']) ? $_GET['orderby']: ''}}"   id="getsort">
						<!-- single widget -->
						<div class="info_widget">
							<div class="small_slider">
								<!-- single_slide -->
								<div class="single_slide">
									<img src="{{asset('client/img/slider/8.jpg')}}" alt="" />
									<div class="s_slider_text">
										<h2>MEET <br />THE <br />MARKET</h2>
									</div>
								</div> 
								<!-- single_slide -->
								<div class="single_slide">
									<img src="{{asset('client/img/slider/7.jpg')}}" alt="" />
									<div class="s_slider_text another">
										<h2>AWESOME <br />BANNER</h2>
									</div>
								</div> 
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-9 ">
					<div class="row">
						<!--product category right sidebar -->
						<div class="category_right_area">
							<div class="view_sort_area">
								<div class="col-lg-4 col-md-4 col-sm-6 ">
									<div class="sort_section">
										<ul class="sort-bar">
											<li class="sort-bar-text">Sort by: </li>
											<li> 
												<div class="select-wrapper">
													<select class="orderby form-control" name="orderby" id="orderbyprice"> 
														<option value="">Default</option>
														<option value="asc">Price: low to high</option>
														<option value="desc">Price: high to low</option>	
													</select>
												</div>
											</li>
										</ul>
									</form>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 ">
							</div>
						</div>
						<!-- PRODUCTS -->
						<div class="cat_all_aitem">
							<div class = 'short-width-slider'>
								<div class = 'cat_slider'>
									@if(count($products) == 0)
									<p>No products!</p>
									@endif
									@foreach($products as $key => $product)
									<div class="single_item">
										<!-- product Item -->
										<a href="{{route('products.show',$product->slug)}}">
											<div class = 'item' style="position: relative;">
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
											@if ($product->promotion)
											<del><span class="amount nrb">{{ $product->price }}đ</span></del>
											<span class="price"><span class="amount">{{ $product->price - intval(($product->price * $product->promotion)/100) }}đ</span></span>
											@else    
											<span class="price"><span class="amount">{{ $product->price }}đ</span></span>
											@endif
										</div>
										@if ($product->promotion)
										<div class="inner">
											<div class="inner-text">Sale!</div>
										</div>
										@endif
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>	
				</div>
				<!-- paginate -->
				<div class="">
					{{$products->links()}}	
				</div>
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
<script src="{{asset('client/js/setabout.js')}}"></script>	
<script type="text/javascript">
	var orderby = $("#getsort").val();
	var productname = $("#productname").val();
	$("input[name='category']").change(function(){ 
		if (!productname) {
			document.getElementById("productname").setAttribute("disabled", true);
		}
		if (!orderby) {
			document.getElementById("orderbyprice").setAttribute("disabled", true);
		}
		this.form.submit();
	});
	$("input[name='price']").change(function(){ 
		if (!productname) {
			document.getElementById("productname").setAttribute("disabled", true);
		}
		if (!orderby) {
			document.getElementById("orderbyprice").setAttribute("disabled", true);
		}
		this.form.submit();
	});
	$("input[name='color']").change(function(){ 
		if (!productname) {
			document.getElementById("productname").setAttribute("disabled", true);
		}
		if (!orderby) {
			document.getElementById("orderbyprice").setAttribute("disabled", true);
		}
		this.form.submit();
	});
	$("#orderbyprice").change(function(){
		if (!productname) {
			document.getElementById("productname").setAttribute("disabled", true);
		}
		this.form.submit();
	});
	@if(isset($_GET['category']))
		$('input:radio[name=category]').val(['{{$_GET['category']}}']);
	@endif
	@if(isset($_GET['price']))
		var price = '{{$_GET['price']}}';
		if (price.indexOf('&gt;') != -1) {
			price = price.replace('&gt;','>');
		}
		if (price.indexOf('&lt;') != -1) {
			price = price.replace('&lt;','<');
		} 
		$('input:radio[name=price]').val([price]);   
	@endif
	@if(isset($_GET['color']))
		$('input:radio[name=color]').val(['{{$_GET['color']}}']);
	@endif
</script>
<!--PRODUCT CATEGORY START -->
@endsection