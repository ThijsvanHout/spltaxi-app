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
	
	
<div class="about-us-text dc-details ">
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
						
						   <p><strong>Name:</strong> {{ $booking->name }}</p>
                    <p><strong>Pickup Address:</strong> {{ $booking->pickup_address }}, {{ $booking->house_no_from }}</p>
                    <p><strong>Number of Persons:</strong> {{ $booking->press }}</p>
                    <p><strong>Contact:</strong> {{ $booking->phone }}</p>
                    <p><strong>Pickup Date:</strong> {{ $booking->pickup_date }}</p>
                    <p><strong>Pickup Time:</strong> {{ $booking->pickup_time }}</p>
						<p><strong>Flight No:</strong> {{ $booking->flight_no_on_return }}</p>
						<p><strong>Price: </strong><i class="fa-solid fa-euro-sign"></i> {{ $booking->price }} </p>
						<p><strong>Commision: </strong> {{ $booking->price1 }} </p>
                    <p><strong>Destination:</strong> {{ $booking->destination }}, {{ $booking->house_no_to }}</p>
                    <!-- Add more booking details here -->

                    <form action="{{ route('driver-confirmation-response', $booking->assign_id) }}" method="POST">
                        @csrf
                        <!-- <button type="submit" name="status" value="accepted" class="btn btn-success">Accept</button> -->
                        @if($booking->status == 'Accepted')
                            <button type="submit" disabled name="status" value="accepted" class="btn btn-success">Accepted</button>
                        @else
                            <button type="submit" name="status" value="accepted" class="btn btn-success">Accept</button>
                        @endif
                        <button type="submit" name="status" value="rejected" class="btn btn-danger">Reject</button>
                    </form>
						
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