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
	.booking-details {
  		padding: 20px;
	}
	.return-button{
		color:white;
		text-align: center;
		margin-bottom:10%;
	}
</style>
<div class="div-padding">
<div class="container">
<div class="row">
<div class="col-lg-5 mx-auto">
<div class="about-us-text dc-details " style="color:#fff">
					<div class="transperant-box">
					@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="heading-box">
						<h3 class="heading-box">Booking <span>Details</span></h3>
						</div>
					<div class="booking-details">
                    {{-- <p><strong>Driver Name:</strong> {{ $booking->driver_name }}</p> --}}
                    <p><strong>Driver Email:</strong> {{ $booking->driver_email }}</p>
                    <p><strong>Driver Contact no.:</strong> {{ $booking->driver_phone }}</p>
                    <p><strong>Driver Car number:</strong> {{ $booking->car_number }}</p>
                    <p><strong>Pickup Address:</strong> {{ $booking->pickup_address }}, {{ $booking->house_no_from }}</p>
                    <p><strong>Number of Persons:</strong> {{ $booking->press }}</p>
                    <p><strong>Pickup Date:</strong> {{ $booking->pickup_date }}</p>
                    <p><strong>Pickup Time:</strong> {{ $booking->pickup_time }}</p>
                    <p><strong>Destination:</strong> {{ $booking->destination }}, {{ $booking->house_no_to }}</p>
                    <!-- Add more booking details here -->
						</div>
					</div>
                </div>
	<div class="return-button">
		<a href="{{ url('/admin/bookings') }}"><button class="btn-grad ">Return to Bookings</button></a>
	</div>			
</div>
</div>
</div>
</div>
@endsection