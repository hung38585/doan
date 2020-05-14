@extends('user.layout.main')
@section('title','Product Detail')
@section('content')
<style>
	input#quantity{
		float: left;
		margin-top: 1px;
		padding: 7px 0px;
		border: 1px solid #e6e6e6;
		margin-left: 2px;
		margin-right: 2px;
	}
</style>
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
				<a href="">Sale</a>
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
								<a href="">Sale</a>
							</li>
						</ul>						
					</nav>
				</div>
				<!--DESKTOP MENU END -->
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA START -->
<div class="breadcrumb_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">	
				<div class="breadcrumb-row">
					<h3 class="breadcrumb"><a href="/" class="home">Home</a> <span>/</span> <a href="{{url('products')}}">Products</a> <span>/</span>{{$product->name}}</h3>
				</div>
			</div>
		</div>
	</div>
</div>
@if(session('success'))
<div class="alert alert-success text-center" >
	{{ session('success') }}
</div>
@endif
<!--MAIN MENU AREA  END-->
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
				<div class="info_widget">
					<div class="section_title">
						<h2 class="" style="float: left;">Top Rated Products</h2>
					</div>
					<div style="clear: both;"></div>
					<div class="top_single_prodct">
						<a href="#"><img src="{{asset('client/img/top-rated-prouducts/1.jpg')}}" alt="" /></a>
						<div class="info">
							<p class="name"><a href="#">Iphone 5S</a></p>
							<div class="star-rating fullstr  ">
								<span style="width:80%"><strong class="rating"> </strong> </span>
							</div>
							<span class="price"><span class="amount">$199.00</span></span>
						</div>
					</div>
					<div class="top_single_prodct">
						<a href="#"><img src="{{asset('client/img/top-rated-prouducts/1.jpg')}}" alt="" /></a>
						<div class="info">
							<p class="name"><a href="#">Samsung Galaxy S5</a></p>
							<div class="star-rating fullstr  ">
								<span style="width:80%"><strong class="rating"> </strong> </span>
							</div>
							<span class="price"><span class="amount">$299.00</span></span>
						</div>
					</div>
					<div class="top_single_prodct">
						<a href="#"><img src="{{asset('client/img/top-rated-prouducts/1.jpg')}}" alt="" /></a>
						<div class="info">
							<p class="name"><a href="#">HTC one</a></p>
							<div class="star-rating fullstr  ">
								<span style="width:80%"><strong class="rating"> </strong> </span>
							</div>
							<span class="price"><span class="amount">$199.00</span></span>
						</div>
					</div>
				</div>	
				<div class="info_widget">
					<div class="small_slider">
						<!-- single_slide -->
						<div class="single_slide">
							<img src="{{asset('client/img/slider/7.jpg')}}" alt="" />
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
			<div class="col-lg-9 col-md-9 col-sm-9 ">
				<div class="row">
					<div class="product_gallery_img">
						<div class="col-lg-6 col-md-6 col-sm-6 ">
							<div class="product_gallery">
								<ul id="gallery_imgs">
									<li><a class="fancybox" data-fancybox-group="group" href="{{asset('images/'.$product->image)}}"><img src="{{asset('images/'.$product->image)}}" alt="" style="height: 450px;" /></a></li>
									@foreach($images as $key=>$value)
									<li><a class="fancybox" data-fancybox-group="group" href="{{asset('images/'.$value->name)}}"><img src="{{asset('images/'.$value->name)}}" alt="" style="height: 450px;" /></a></li>
									@endforeach 
								</ul>
								<div class="bxpage_slider" id="bx-pager" style="margin-top: -40px;">
									<a data-slide-index="0"  href=""><img class="select" src="{{asset('images/'.$product->image)}}" style="height: 100px;" /></a>
									@foreach($images as $key=>$value)
									<?php ++$key ?>
									<a data-slide-index="{{$key}}"  href=""><img class="select" src="{{asset('images/'.$value->name)}}" style="height: 100px;" /></a>
									@endforeach 
								</div>
							</div>
						</div>	
						<div class="col-lg-6 col-md-6 col-sm-6 ">
							<div class="product_info">
								<div class="info">
									<p class="name">{{$product->name}}</p>
									<input type="hidden" value="{{ $product->id }}" id="productid">
									<div class="star-rating  ">
										<span style="width:80%"><strong class="rating"> </strong> </span>
									</div>
									<span class="price"><span class="amount">{{$product->price}}$</span></span>
									<br><br>
								</div>
								<div class="sort_section">
									<form action="{{ url('add-to-cart/'.$product->id) }}" onsubmit="return checkform();">
										<!-- size -->
										<ul class="sort-bar">
											<li class="sort-bar-text">Size: </li>
											<li></li>
											<li  class="customform" >
												<?php
												if (isset($sizes)) {
													$list = array();
													foreach ($sizes as $key => $size) {
														$list[] = $size->size;
													}
													$list = array_unique($list);
												}
												?>
												<div class="select-wrapper">
													<select name="size" class="orderby" id="size">
														<option value="" selected="selected">
														Select size!</option>
														@foreach($list as $key => $size)
														<option value="{{$size}}">{{$size}}</option>
														@endforeach
													</select>
												</div>
											</li>
										</ul>
										<!-- color -->
										<ul class="sort-bar">
											<li class="sort-bar-text">Color: </li>
											<li></li>
											<li  class="customform" >
												<div class="select-wrapper">
													<select name="color" class="orderby" id="color">
														<option value="">Selcet color!</option>
													</select>
												</div>
											</li>
										</ul> 
										<!-- quantity -->
										<ul class="sort-bar">
											<li class="sort-bar-text">Quantity: </li>
											<li></li>
											<li class="customform" >
												<button type="button" class="btn" onclick="document.getElementById('quantity').stepDown();" style="float: left;">-</button>
												<input type="number" name="quantity" min="1" max="100" value="1" class="text-center"  id="quantity">
												<button type="button" class="btn" onclick="document.getElementById('quantity').stepUp();">+</button>
												<span style="margin-left: 10px;">  Products available: <span id="quantityava" class="text-danger">{{ $quantity }}</span></span>
											</li>
										</ul>
										<p class="checkerr text-danger"></p>
										<button type="submit" class="btn btn-success"><i class="fas fa-cart-plus" style="font-size: 20px;"></i> <b>ADD TO CART</b></button>
									</form>	
								</div>
								<div class="product_meta">
									<span class="sku_wrapper">Brand: {{$product->brand->name}}</span>
									<span class="posted_in">Category: <a rel="tag" href="{{route('products.index')}}?category={{$product->category->name}}">{{$product->category->name}}</a></span>
								</div>
							</div>
						</div>	
					</div>
					<!--PRODUCT TAB COLLECTION AREA   START -->
					<div class="tab_collection_area product_tab ">
						<div id="tab-container" class='tab-container'>
							<ul class='etabs '>
								<li class='tab'><a href="#description">Description</a></li>
								<li class='tab'><a href="#reviews">Reviews (1)</a></li>
							</ul>
							<div class='panel-container'>
								<!-- first_collection -->
								<div id="description">	
									{!! $product->description !!}
								</div>
								<!-- second_collection -->
								<div id="reviews">
									<div class="contact_from">
										<form action="#">
											<p class="comment-form-author">
												<label>Name</label> 
												<input type="text"  placeholder="Type Your Name Here" >
											</p>
											<p class="comment-form-author">
												<label>Email</label> 
												<input type="text"  placeholder="Type Your Email Here" >
											</p>
											<p class="reviewstar">
												<label>Your Rating</label>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
											</p>
											<p class="comment-form-textarea">
												<label>Your Review</label> 
												<textarea >  </textarea> 
											</p>
											<p class="form-submit">
												<input type="submit" value="Submit">
											</p>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--PRODUCT TAB COLLECTION AREA  END -->
				</div>	
				<!-- RELATED  PRODUCS  -->
				<div class="featured_producs related_product ">
					<div class="section_title">
						<h2>Related Products</h2>
					</div>
					<div class = 'slider8'>
						<!-- product Item -->
						<div class="single_item">
							<!-- product Item -->
							<div class = 'item' >
								<div class="product_img">
									<img src="{{asset('client/img/products/1.jpg')}}" alt="" />
								</div>
							</div>
							<!-- product info -->
							<div class="info">
								<p class="name"><a href="#">Split Side Pink Crepe</a></p>
								<div class="star-rating">
									<span style="width:80%"><strong class="rating"> </strong> </span>
								</div>
								<span class="price"><span class="amount">$20.00</span></span>
							</div>
						</div>
						<!-- product Item -->
						<div class=" single_item">
							<div class = 'item' >
								<div class="product_img">
									<img src="{{asset('client/img/products/1.jpg')}}" alt="" />
								</div>
							</div>
							<!-- product info -->
							<div class="info ">
								<p class="name"><a href="#">Striped Asymmetric</a></p>
								<div  class="star-rating fullstr ">
									<span style="width:80%"><strong class="rating "> </strong> </span>
								</div>
								<span class="price"><span class="amount">$36.00</span></span>
							</div>
							<div class="inner">
								<div class="inner-text">Sale!</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Related Products PRODUCS END  -->
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
	function checkform() {
		var size = $('#size').val();
		var color = $('#color').val();
		var result = true;
		var quantityava = $('#quantityava').html();
		var quantity = $('#quantity').val();
		if (!size || !color) {
			$('.checkerr').html('Please select Size and Color!');
			result = false;
		}else{
			if (quantity > quantityava) {
				result = false;
				$('.checkerr').html('Quantity must be less than '+quantityava+'!');
			}
		}
		return result;
	}
	$('select#size').change(function(){
		var size = $(this).val();
		var product_id = $('#productid').val();
		if (size) {
			$.ajax({
				type: 'get',
				url: '{{ URL::to('get_color_in_productdetail') }}',
				data: {
					product_id: product_id,
					size: size
				},
				success:function(data){
					$option = '<option value="">Selcet color!</option>';
					for (var i = 0; i < data.length; i++) {
						$option += '<option value="'+data[i]+'">'+data[i]+'</option>';
					}
					$('#color').html($option);
				}
			});
			getquantity(product_id,size,'');
		}else{
			$('#color').html('<option value="">Selcet color!</option>');
			$('#quantityava').html({{$quantity}});
		}
	});
	$('select#color').change(function(){
		var color = $(this).val();
		var product_id = $('#productid').val();
		var size = $('#size').val();
		getquantity(product_id,size,color);
	});
	function getquantity(product_id,size,color) {
		$.ajax({
				type: 'get',
				url: '{{ URL::to('get_quantity_in_productdetail') }}',
				data: {
					product_id: product_id,
					size: size,
					color: color
				},
				success:function(data){
					$('#quantityava').html(data);
				}
			});
	}
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<!-- RIGHT SIDEBAR MENU AREA END -->
@endsection