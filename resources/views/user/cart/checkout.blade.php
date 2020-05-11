@extends('user.layout.main')
@section('title','Checkout')
@section('content')
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
<!--BREADCRUMB AREA START -->
<div class="breadcrumb_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">	
				<div class="breadcrumb-row">
					<h3 class="breadcrumb"><a href="/" class="home">Home</a><span>/</span><a href="/cart" class="home">Shopping Cart</a><span>/</span>Checkout</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA END -->
<!--PAGE-CHECKOUT-DETAIL AREA START -->
<div class="page-checkout_area checkout-detail ">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="checkout-breadcrumb">
					<a href="{{ url('cart') }}">
						<div class="title-cart">
							<span>1</span>
							<p>Shopping Cart</p>
						</div>
					</a>
						<div class="title-checkout title-cart">
							<span>2</span>
							<p>Checkout details</p>
						</div>
					<div class="title-thankyou">
						<span>3</span>
						<p>Order Complete</p>
					</div>
				</div>
				<form method="POST" action="{{ url('/placeorder') }}" onsubmit="return validate();" >
				@csrf
				<div class="row"> 
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="Your_order">
							<h2>Your order</h2>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 30px; margin-bottom: 20px;">
							<div class="last-order">
								<table id="order_review" class="shop_table">
									<thead>
										<tr>
											<th class="product-name">Product</th>
											<th class="product-total">Total</th>
										</tr>
									</thead>
									<tbody>
										<?php $total = 0; ?>
										@foreach(session('cart') as $id => $product)
										<tr class="cart_item">
											<td class="product-name">
												<a href="{{route('products.show',$product['slug'])}}" style="font-size: 15px;">{{ $product['name'] }}</a>
												<input type="hidden" name="product_detail_id[]" value="{{ $product['id'] }}">
												<input type="hidden" name="quantity[]" value="{{ $product['quantity'] }}">
												<strong class="product-quantity">× {{ $product['quantity'] }}</strong>
											</td>
											<td class="product-total">
												<span class="amount">${{ $product['quantity'] * $product['price'] }}</span>
											</td> 
										</tr>
										<input type="hidden" value="{{ $product['price'] }}" name="price[]">
										<?php $total += $product['quantity'] * $product['price']; ?>
										@endforeach
									</tbody>
									<tfoot>
										<tr class="cart-subtotal">
											<th>Cart Subtotal</th>
											<td><span class="amount">${{ $total }}</span></td>
										</tr>
										<tr class="shipping">
											<th>Shipping</th>
											<td>Free Shipping</td>
										</tr>
										<tr class="order-total">
											<th>Order Total</th>
											<td>
												<strong><span class="amount">${{ $total }}</span></strong>
												<input type="hidden" value="{{ $total }}" name="total_amount">
											</td>
										</tr>
									</tfoot>

								</table>
							</div>
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="card_area calcul">
								<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingOne">
											<h4 class="panel-title">
												<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
													Direct Bank Transfer 
												</a>
											</h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
											<div class="panel-body">
												Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="headingThree">
											<h4 class="panel-title">
												<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
													PayPal <img src="{{ asset('client/img/AM_mc_vs_ms_ae_UK.png')}}" alt="AM_mc_vs_ms_ae_UK.png" />
												</a>
											</h4>
										</div>
										<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
											<div class="panel-body">
												Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>		
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="Billing_Details_area">
							<h2>Billing Details</h2>
							<div class="beling_info">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="bell_ditl_s">
											<div class="level">
												First Name <span class="required" title="required">*</span>
											</div>
											<input type="text" placeholder="First Name" value="{{ Auth::guard('client')->user()->first_name}}" name="first_name" id="first_name" />
											<span id="first_nameerr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6"> 
										<div class="bell_ditl_s">
											<div class="level">
												Last Name <span class="required" title="required">*</span>
											</div>
											<input type="text" placeholder="Last Name" value="{{ Auth::guard('client')->user()->last_name}}" name="last_name" id="last_name" />
											<span id="last_nameerr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12">
										<div class="bell_ditl_s">
											<div class="level">
												Address <span class="required" title="required">*</span>
											</div>
											<input type="text" placeholder="Street, City" value="{{ Auth::guard('client')->user()->address}}" name="address" id="address" />
											<span id="addresserr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="bell_ditl_s">
											<div class="level">
												Email Address <span class="required" title="required" >(Street, City)*</span>
											</div>
											<input type="text" placeholder="Email" value="{{ Auth::guard('client')->user()->email}}" name="email" id="emailuser" />
											<span id="emailerr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6">
										<div class="bell_ditl_s">
											<div class="level">
												Phone <span class="required" title="required">*</span>
											</div>
											<input type="text" placeholder="Phone number" value="{{ Auth::guard('client')->user()->phone}}" name="phone" id="phonenumber" />
											<span id="phoneerr" class="text-danger"></span>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12">
											<div class="bell_ditl_s hhf">
												<div class="level">
													Order Notes<span class="required" title="required">*</span>
												</div>												
												<textarea name="notes"  placeholder="Notes about your order." style="min-height: 150px;"></textarea>
											</div>
										</div>
								</div> 
								<input type="submit" value="Place order" class="buttons" style="margin-top: 30px;" />
							</div>
						</div>
					</div>
				</div>	
				</form>
			</div>
		</div>
	</div>
</div>
<!--PAGE-CHECKOUT-DETAIL AREA END -->

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
function validate() {
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var address = $("#address").val();
	var email = $("#emailuser").val();
	var phone = $("#phonenumber").val();	
	var result = true;
	if (!first_name) {
		result = false;
		$('#first_nameerr').html("Please enter First Name.");
	}else{
		$('#first_nameerr').html("");
	}
	if (!last_name) {
		result = false;
		$('#last_nameerr').html("Please enter Last Name.");
	}else{
		$('#last_nameerr').html("");
	}
	if (!address) {
		result = false;
		$('#addresserr').html("Please enter Address.");
	}else{
		$('#addresserr').html("");
	}
	if (!email) {
		result = false;
		$('#emailerr').html("Please enter Email.");
	}else{
		$('#emailerr').html("");
		if (!validateEmail(email)) {
			result = false;
			$('#emailerr').html("Email is is not valid.");
		}
	}
	if (!phone) {
		result = false;
		$('#phoneerr').html("Please enter Phone.");
	}else{
		$('#phoneerr').html("");
		var phoneno = /^\d{10}$/;
		if(!phone.match(phoneno)){
			result = false;
			$('#phoneerr').html("Phone is is not valid.");
		}
	}
	return result;
}
function validateEmail(email) {
  	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  	return re.test(email);
}
</script>
@endsection