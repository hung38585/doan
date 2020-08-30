@extends('admin.layout.main')
@section('title','Reply Comment')
@section('content')
<div class="page-header">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="/admin/home">Admin</a></li>
		<li class="breadcrumb-item active" >Edit comment</li>
	</ol>
</div>
<div class="card row"> 
	{{ Form::model($comment,['route' => ['comment.update',$comment->id],'method' => 'put', 'onSubmit'=>'return validate()']) }}
	<div class="col-md-8">
		<ul class="list-group list-group-flush">
			<li class="list-group-item" style="height: 60px;"><span class="col-md-3">User: </span>
				<div class="col-md-8">{{$comment->user->username}}</div>
			</li>
			<li class="list-group-item" style="height: 60px;"><span class="col-md-3">Product Name: </span>
				<div class="col-md-8">{{$comment->product->name}}đ</div>
			</li>
			<li class="list-group-item" style="height: 60px;"><span class="col-md-3">Star: </span>
				<div class="col-md-8">{{$comment->star}}</div>
			</li> 
			<li class="list-group-item" style="height: 60px;"><span class="col-md-3">Comment: </span>
				<div class="col-md-8">{{$comment->content}}</div>
			</li> 
		</ul> 
	</div> 
	<div class="col-md-4">
		<label for="">Reply:</label>
		{{ Form::textarea('reply','',['id'=>'reply','rows'=>'4','cols'=>'40'])}}
		<p class="text-danger replyerr"></p>
		{{ Form::submit('Update',['class'=>'btn btn-success update']) }}
		<a class="btn btn-danger" href="{{route('comment.index')}}">Back</a>
	</div> 
	{{ Form::close() }}  
</div> 
<script>
	function validate() {
		var reply = $("#reply").val();
		if (!reply) {
			$(".replyerr").html("Reply must not be blank!");
			return false;
		}
		return true;
	}
</script>
@endsection