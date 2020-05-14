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
	<p class="alert alert-success notification">{{ Session::get('message')}}</p> 
	@elseif(Session::has('err'))    
	<p class="alert alert-danger notification">{{ Session::get('err')}}</p>
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
					<th >#</th>
					<th >Order code</th>
					<th>Total amount</th>
					<th>Status</th>
					<th>Transaction date</th>
					<th>Username id</th>
					<th colspan="5">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($orders as $key => $order)
					<tr>
						<td >{{ ++$key }}</td>
						<td >{{ $order->order_code }}</td>
						<td>{{$order->total_amount}}</td>
						@switch($order->status)
						    @case('unconfimred')
						        <td ><span class="label label-warning col-md-8 " style="font-size: 13px;" >{{$order->status}}</span></td>
						        @break 
						    @case('confimred')
						        <td ><span class="label label-success col-md-8" style="font-size: 13px;" >{{$order->status}}</span></td>
						        @break
							@case('cancel')
						        <td ><span class="label label-danger col-md-8" style="font-size: 13px;" >{{$order->status}}</span></td>
						        @break
						    @case('delivery')
						        <td ><span class="label label-info col-md-8" style="font-size: 13px;" >{{$order->status}}</span></td>
						        @break
						    @case('delivered')
						        <td ><span class="label label-primary col-md-8" style="font-size: 13px;" >{{$order->status}}</span></td>
						        @break          
						    @default
						         
						@endswitch
						
						<td>{{$order->transaction_date}}</td>
						<td>
							@if($order->user_id)
								{{$order->user_id}}
							@else
								At store
							@endif
						</td>
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