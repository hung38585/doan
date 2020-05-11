@extends('admin.layout.main')
@section('title','Order')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="">Admin</a></li>
		<li class="breadcrumb-item active" >Order</li>
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
	<div class="card-body">
		<div class="row">
			<div class="col-md-9">
				<a href="{{route('order.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					{{ Form::open(['route' => ['order.index' ],'method' => 'get']) }}
					{{ Form::text('seachname','',['class'=>'form-control ','style'=>'float: left','placeholder'=>'Search Name']) }}
				</div>
				{{ Form::close() }}	
			</div>
		</div>
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th >STT</th>
					<th >Order code</th>
					<th>Total amount</th>
					<th>Status</th>
					<th>Transaction date</th>
					<th>Username</th>
					<th colspan="5">#</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($orders as $key => $order)
					<tr>
						<td >{{ ++$key }}</td>
						<td >{{ $order->order_code }}</td>
						<td>{{$order->total_amount}}</td>
						<td>{{$order->status}}</td>
						<td>{{$order->transaction_date}}</td>
						<td>{{$order->user_id}}</td>
						<td colspan="5">
							<a href="{{route('order.edit',$order->id)}}" class="ml-1 btn" style="width:40px; padding: 5px;"><i class="fa fa-edit "></i></a>
						</td>
					</tr>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>

{{ Form::close() }}
@endsection