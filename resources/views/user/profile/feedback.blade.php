@extends('user.layout.main')
@section('title','Feedback')
@section('content')
<style type="text/css" media="screen">
	/* Rating Star Widgets Style */
	.rating-stars ul {
		list-style-type:none;
		padding:0;
		-moz-user-select:none;
		-webkit-user-select:none;
	}
	.rating-stars ul > li.star {
		display:inline-block;  
	}
	/* Idle State of the stars */
	.rating-stars ul > li.star > i.fa {
		font-size:1em; /* Change the size of the stars */
		color:#ccc; /* Color on idle state */
	}

	/* Hover state of the stars */
	.rating-stars ul > li.star.hover > i.fa {
		color:#FFCC36;
	}

	/* Selected state of the stars */
	.rating-stars ul > li.star.selected > i.fa {
		color:#FF912C;
	}
</style>
<div class='rating-stars text-center'>
	<ul id='stars' style="font-size: 25px;">
		<li class='star' title='Poor' data-value='1' id="1">
			<i class='fa fa-star fa-fw'></i>
		</li>
		<li class='star' title='Fair' data-value='2' id="2">
			<i class='fa fa-star fa-fw'></i>
		</li>
		<li class='star' title='Good' data-value='3' id="3">
			<i class='fa fa-star fa-fw'></i>
		</li>
		<li class='star' title='Excellent' data-value='4' id="4">
			<i class='fa fa-star fa-fw'></i>
		</li>
		<li class='star' title='WOW!!!' data-value='5' id="5">
			<i class='fa fa-star fa-fw'></i>
		</li>
	</ul>
	<input type="text" class="starvalue">
</div>
<script>
	$(document).ready(function(){
		/* 1. Visualizing things on Hover - See next part for action on click */
		$('#stars li').on('mouseover', function(){ 
    		var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on 
    		// Now highlight all the stars that's not after the current hovered star
    		$(this).parent().children('li.star').each(function(e){
    			if (e < onStar) {
    				$(this).addClass('hover');
    			}
    			else {
    				$(this).removeClass('hover');
    			}
    		}); 
    	}).on('mouseout', function(){
    		$(this).parent().children('li.star').each(function(e){
    			$(this).removeClass('hover');
    		});
    	});
    	/* 2. Action to perform on click */
    	$('#stars li').on('click', function(){
	    	var onStar = parseInt($(this).data('value'), 10); // The star currently selected
	    	var stars = $(this).parent().children('li.star'); 
	    	for (i = 0; i < stars.length; i++) {
	    		$(stars[i]).removeClass('selected');
	    	}
	    	for (i = 0; i < onStar; i++) {
	    		$(stars[i]).addClass('selected');
	    	}
			// JUST RESPONSE (Not needed)
			var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
			var msg = "";
			if (ratingValue > 1) {
				msg = "Thanks! You rated this " + ratingValue + " stars.";
			}
			else {
				msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
			}
			responseMessage(msg);   
		});
		$(".star").click(function(){
			$(".starvalue").val($(this).data('value'));
		}) ;
    });
	function responseMessage(msg) {
		$('.success-box').fadeIn(200);  
		$('.success-box div.text-message').html("<span>" + msg + "</span>");
	}	
</script>
@endsection