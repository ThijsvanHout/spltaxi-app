<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Thank you for your booking. Here are the details:</p>

    <p><strong>Date, Time:</strong> {{ $bookingDetails['pickup_date'] }} at {{ $bookingDetails['pickup_time'] }}</p>
    
    <p><strong>Passenger(s):</strong> {{ $bookingDetails['press'] }}</p>
    <p><strong>Luggage:</strong> {{ $bookingDetails['luggage'] }}</p>
    <p><strong>Vehicle:</strong> {{ $bookingDetails['vehicle'] }}</p>
    <p><strong>From:</strong> {{ $bookingDetails['pickup_address'] }} House No: {{ $bookingDetails['house_no_from'] }}</p>
    <p><strong>To:</strong> {{ $bookingDetails['to'] }} House No: {{ $bookingDetails['house_no_to'] }}</p>
   <p><strong>Price:</strong> 
		Customer: 
		@isset($bookingDetails['price'])
			€ {{ $bookingDetails['price'] }}
		@else
			N/A
		@endisset    
	</p>

    <p><strong>Payment Mode:</strong> {{ $bookingDetails['mode'] }}</p>
    <p><strong>Contact Info:</strong> Mobile: {{ $bookingDetails['mobile'] }}, Email: {{ $bookingDetails['email'] }}, Name: {{ $bookingDetails['uname'] }}</p>
  
    <p><strong>Return Booking:</strong> {{ $bookingDetails['return'] }}</p>
	@if($bookingDetails['return'] == "Yes")
    <p><strong>Flight Details:</strong> No: {{ $bookingDetails['flight_no'] }}, Date: {{ $bookingDetails['flight_date'] }}, Time: {{ $bookingDetails['flight_time'] }}</p>
	@endif
    <p><strong>Remark:</strong> {{ $bookingDetails['remark'] }}</p>
	
	<p>Met vriendelijke groet,</p>		
	Roy /www.spl.taxi<br>
	info@spl.taxi<br>
	06-51044996<br>
	085 - 060 05 05<br>
	020 - 681 38 37

</body>
</html>
