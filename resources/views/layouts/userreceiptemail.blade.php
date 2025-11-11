

<style>
	.dc-details{
		color: black;
	  	text-align: center;
		padding-bottom: 50px;
	}
	
	.email-header{
		padding-top:20px;
	}
	
	.email-footer{
		padding-top: 30px;
	}
	
	.white-box{
		padding:0;
		background-color: white;
		color: black;
	}
	
	.booking-details {
  		padding-left: 20px;
	}
	
</style>
<div class="div-padding">
<div class="container">
<div class="row">
<div class="">
	<div>
		<div>
			
			<div class="">
				<div class="dc-details mb-3">
                    <a href="https://www.spl.taxi/"><img src="{{ asset('frontend/images/logo.png') }}" alt="logo"></a>					
                </div>
				
				<div>
					<p>Hello {{ $booking->name }},
				
				<h2 class="email-header">Booking <span>Receipt</span></h2>
				
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
			
			<div class="email-footer">
				<h5 class="text-dark"><strong>Admin tel. number: 020 6813837</strong>  <strong>Email: info@spl.taxi</strong></h5>
			</div>	
		</div>
	</div>				
</div>
</div>
</div>
</div>