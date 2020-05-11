@extends('admin.layout.main')
@section('title','Product')
@section('content')
<div class="page-header">
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="">Admin</a></li>
	<li class="breadcrumb-item active">Product</li>
</ol>
</div>
<div class="row ml-1 col-md-12">
	@if (Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message')}}</p> 
	@elseif(Session::has('err'))    
	<p class="alert alert-danger">{{ Session::get('err')}}</p>
	@endif
</div>
<div class="card">
<div class="card-body col-md-12">
	<div class="row">
		<div class="col-md-9">
			<a href="{{route('product.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				{{ Form::open(['route' => ['product.index' ],'method' => 'get']) }}
					{{ Form::text('name','',['class'=>'form-control ','style'=>'float: left','placeholder'=>'Search Name']) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<table class="table table-striped table-sm">
		<thead class="">
			<tr>
				<th scope="col">STT</th>
				<th scope="col">Product code</th>
				<th scope="col">Name</th>
				<th scope="col">Image</th>
				<th scope="col">Price</th>
				<th >#</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				@foreach($products as $key => $product)
				<tr>
					<td class="">{{ ++$key }}</td>
					<td class="">{{ $product->product_code }}</td>
					<td class=""><a href="{{route('product.show',$product->id)}}" style="text-decoration: none;color: black;">
						{{ $product->name }}</a>
					</td>
					<?php  $image = explode(',',$product->image);	?>
					<td><img src="{{ asset('images/'.$image[0]) }}" width="50" height="50"></img></td>
					<td class="">{{$product->price}}</td>
					<td colspan="5">
						<!-- Button trigger modal -->
						<!-- Tạo data-id để chưa giá trị id -->
						<button type="button" class="fa fa-trash deleteUser text-danger btn" data-id="{{$product->id}}" data-toggle="modal" data-target="#Modal" style="width: 40px; padding: 7px 5px;">
						</button>
						<a href="{{route('product.edit',$product->id)}}" class="ml-1 btn" style="width:40px; padding: 5px;"><i class="fa fa-edit "></i></a>
					</td>
				</tr>
				@endforeach
			</tr>
		</tbody>
	</table>
</div>
</div>
{{Form::open(['route' => 'product_delete_modal', 'method' => 'POST', 'class'=>'col-md-5'])}}
{{ method_field('DELETE') }}
{{ csrf_field() }}
<!-- Modal -->
@include('admin.Modal.delete')
{{ Form::close() }}
@endsection