@extends('admin.layout.main')
@section('title','User')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/admin/home">Admin</a></li>
		<li class="breadcrumb-item active">User</li>
	</ol>
</div>
<div class="row ml-1">
	@if (Session::has('message'))
	<p class="alert alert-success notification">{{ Session::get('message')}}</p> 
	@elseif(Session::has('err'))    
	<p class="alert alert-danger notification">{{ Session::get('err')}}</p>
	@endif
</div>
<div class="card">
	<div class="card-body ">
		<div class="row">
			<div class="col-md-9">
				<a href="{{route('user.create')}}" class="btn btn-outline-success mb-2 mt-2">Create New</a>
			</div>
			<div class="col-md-3"> 	
			</div>
		</div>
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th >#</th>
					<th >Username</th>
					<th >Level</th>
					<th >Email</th>
					<th colspan="5">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach($users as $key => $user)
					<tr>
						<td >{{ ++$key }}</td>
						<td>{{$user->username}}</td> 
						<td>{{$user->level}}</td> 
						<td>{{$user->email}}</td> 
						<td colspan="5"> 
							<!-- Button trigger modal -->
							<!-- Tạo data-id để chưa giá trị id -->
							@if($user->isdelete == 0)
							<button type="button" class="fas fa-lock deleteUser text-danger btn" data-id="{{$user->id}}" data-toggle="modal" data-target="#Modal" style="width: 40px; padding: 7px 5px;">
							</button>
							@else
							<button type="button" class="fas fa-unlock-alt deleteUser unlockuser text-success btn" data-id="{{$user->id}}" data-toggle="modal" data-target="#Modal" style="width: 40px; padding: 7px 5px;">
							</button> 
							@endif
							<a href="{{route('user.edit',$user->id)}}" class="ml-1 btn" style="width:40px; padding: 4px;background: #f0f0f0;"><i class="fa fa-edit "></i></a>
						</td>
					</tr>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>
{{Form::open(['route' => 'user_delete_modal', 'method' => 'POST', 'class'=>'col-md-5'])}}
{{ method_field('DELETE') }}
{{ csrf_field() }}
<!-- Modal -->
@include('admin.Modal.delete')
{{ Form::close() }}
<script>
	$('.yesdel').html('Yes, Lock');
	$('.titledelete').html('Are you sure want to Lock?');
	$('.unlockuser').click(function(){
		$('.yesdel').html('Yes, Unlock');
		$('.titledelete').html('Are you sure want to Unlock?');
		$(".yesily").removeClass("btn-danger");
		$(".yesily").addClass("btn-success");
	});
</script>
@endsection