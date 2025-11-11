@extends('frontend.index')


@section('main-section')


<style>
	.dc-details{
		color: white;
	  	text-align: center;
	  	padding: 100px 0 100px 0;
	}
	
	.transperant-box{
		padding:0;
		background-color: rgba(0, 0, 0, 0.5);
	}
	
	.white-box{
		padding:0;
		background-color: white;
		color: black;
	}
	
	.booking-details {
  		padding: 20px;
	}
	
</style>
<div class="div-padding">
<div class="container">
<div class="row">
<div class="col-lg-5 mx-auto">
	<div class="about-us-text dc-details " style="color:#fff">
		<div class="white-box" >
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif

			<div class="heading-box">
				<h3 class="heading-box">Booking <span>Receipt</span></h3>
				<p class="text-dark"><strong>Admin tel. number: 020 6813837</strong>  <strong>Email: info@spl.taxi</strong></p>
			</div>
			
			<div class="booking-details">   
				<p><strong>Name: </strong>{{ $booking->name }}</p>
				<p><strong>Pickup Address: </strong> {{ $booking->pickup_address }}, {{ $booking->house_no_from }}</p>
				<p><strong>Destination:</strong> {{ $booking->destination }}, {{ $booking->house_no_to }}</p>
				<p><strong>Number of Persons:</strong> {{ $booking->press }}</p>
				<p><strong>Pickup Date:</strong> {{ $booking->pickup_date }}</p>
				<p><strong>Pickup Time:</strong> {{ $booking->pickup_time }}</p>
				<p><strong>Price: </strong><i class="fa-solid fa-euro-sign"></i> {{ $booking->price }} </p>
				<p>Exempt from mentioning vat rate 9%</p>
				<!-- Add more booking details here -->
			</div>
		</div>
	</div>				
</div>
</div>
</div>
</div>
@endsection