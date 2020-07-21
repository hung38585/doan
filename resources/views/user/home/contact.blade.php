@extends('user.layout.main')
@section('title',__('client.Contact'))
@section('content') 
<!--BREADCRUMB AREA START -->
<div class="breadcrumb_area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">	
				<div class="breadcrumb-row">
					<h3 class="breadcrumb"><a href="/" class="home">{{__('client.Home')}}</a><span>/</span>{{__('client.Contact')}}</h3>
				</div>
			</div>
		</div>
	</div>
</div>
<!--BREADCRUMB AREA END -->
<!-- contact-area start -->
<div class="contact-area">
	<div class="container">
		<div class="row">
			<!-- contact-info start -->
			<div class="col-md-6 col-sm-12 col-xs-12 left-con">
				<div class="contact-info">
					<h3>{{__('client.contactinfo')}}</h3>
					<ul>
						<li>
							<i class="fa fa-map-marker"></i> <strong>{{__('profileUser.add')}} :</strong>
							{{$abouts[0]->address}}
						</li>
						<li>
							<i class="fa fa-mobile"></i> <strong>{{__('profileUser.phone')}} :</strong>
							{{$abouts[0]->phone}}
						</li>
						<li>
							<i class="fa fa-envelope"></i> <strong>Email:</strong>
							{{$abouts[0]->email}}
						</li>
					</ul>
				</div>
			</div>
			<!-- contact-info end -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="contact-form">
					<h3><i class="fa fa-envelope-o"></i>{{__('client.LEAVEAMESSAGE')}}</h3>
					<div class="row">
						<form action="{{ url('/sendcontact') }}" method="POST">
							@csrf
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="name" type="text" placeholder="{{__('client.nameRequired')}}" />
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="email" type="email" placeholder="{{__('client.email')}}" />
							</div> 
							<div class="col-md-12 col-sm-12 col-xs-12">
								<textarea name="message" id="message" cols="30" rows="10" placeholder="{{__('client.Message')}}"></textarea>
								<input type="submit" value="{{__('client.sendcontact')}}" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- contact-area end -->
@foreach($abouts as $key => $about)
<input type="hidden" value="{{$about->title}}" id="titlevalue">
<input type="hidden" value="{{$about->name}}" id="namevalue">
<input type="hidden" value="{{$about->address}}" id="addressvalue">
<input type="hidden" value="{{$about->email}}" id="emailvalue">
<input type="hidden" value="{{$about->phone}}" id="phonevalue">
<input type="hidden" value="{{asset('images/'.$about->logo)}}" id="logovalue">
@endforeach
<script src="{{asset('client/js/setabout.js')}}"></script>	
@endsection