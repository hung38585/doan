@extends('admin.layout.main')
@section('title','Detail Product')
@section('content')
<div class="page-header">
    <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/admin/home">Admin</a></li>
		<li class="breadcrumb-item" ><a href="{{route('product.index')}}" title="Danh mục">product</a></li>
		<li class="breadcrumb-item active">Detail</li>
	</ol>
</div>
<div class="card">
	<div class="card-body col-md-12">
		<div class="product_detail">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<div class="product_image">
						<?php  $images = explode(',',$product->image);	?>
						@foreach($images as $key => $image)
						<img src="{{ asset('images/'.$image) }}" ></img>
						@endforeach
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<div class="product_desc">
						<h3 class="product_desc_name">{{$product->name}}</h3>
						<div class="text-light product_desc_description">{!! $product->description !!}</div>
						<hr>
						<h4 class="text-danger product_desc_price"><b>Price:</b> {{number_format($product->price)}}đ</h4>
						<p><b>Promotion : </b>{{$product->promotion}}%</p>
						<p><b>Brand : </b>{{$product->brand->name}}</p>
						<p><b>Category : </b>{{$product->category->name}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection