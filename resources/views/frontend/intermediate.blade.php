<html>
	<style>
		.message {
            font-size: large !important;
            background-color: green !important;
            color: white !important;
        }
		.booking-message{			
			font-size: 16px !important;
		}
		th {
			text-align: left;
		}
		.mail-message {
            font-size: large !important;
            font-weight : bold !important;
            /*color: white !important;*/
        }
		/* Styling for the dialog overlay */
	.custom-dialog {
		position: fixed;
		top: 50%;
		left: 50%;
		/*width: 100%;
		height: 100%;*/
		transform: translate(-50%, -50%);
		display: none;
		/*justify-content: center;
		align-items: center;*/
		z-index: 1000;
	}

	/* Styling for the dialog content */
	.custom-dialog-content {
		background: white;
		padding: 20px;
		border-radius: 5px;
		text-align: center;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
	}

	.custom-dialog-content h3 {
		margin-top: 0;
	}

	.custom-dialog-content p {
		margin-bottom: 20px;
	}

	.custom-dialog-content button {
		padding: 10px 20px;
		margin: 0 10px;
		border: none;
		border-radius: 3px;
		cursor: pointer;
	}

	.custom-dialog-content button:first-child {
		background-color: #007bff;
		color: white;
	}

	.custom-dialog-content button:last-child {
		background-color: #6c757d;
		color: white;
	}

	</style>
			-
<body>
	<!--<div id="booking-message-dialog" class="custom-dialog" style="display: flex;">
		<div class="custom-dialog-content">-->
			<div class="message">
				<p>{{ $message }}</p>
			</div>
			<div  class="booking-message">
				<p class="mail-message">Dank voor uw reservering. <p>
				<p class="mail-message">Bevestiging is verzonden via e-mail, check uw Spam </p>
				<p>Reservering gegevens : </p>
				<table>
					<tr>
						<th>Name</th>
						<td>{{ $booking->name}}</td>
					</tr>
					<tr> 
						<th>From</th>
						<td>{{ $booking->pickup_address}} {{ $booking->house_no_from }}</td>
					</tr>
					<tr> 
						<th>To</th>
						<td>{{ $booking->destination}} {{ $booking->house_no_to }}</td>
					</tr>
					<tr> 
						<th>Mobile</th>
						<td>{{ $booking->phone}}</td>
					</tr>
					<tr>
						<th>Email</th>
						<td>{{ $booking->email }}</td>
					</tr>
					<tr> 
						<th>Payment</th>
						<td>{{ $booking->mode}}</td>
					</tr>
					@if ($booking->price)
						<tr>
							<th>Price</th>
							<td>€ {{ $booking->price }}</td>
						</tr>
					@endif
					<tr> 
						<th>Person(s)</th>
						<td>{{ $booking->press}}</td>
					</tr>
					<tr>
						<th>Luggage</th>
						<td>{{ $booking->luggage }}</td>
					</tr>
					<tr>
						<th>Vehicle</th>
						<td>{{ $booking->vehicle }}</td>
					</tr>
					<tr> 
						<th>Remarks</th>
						<td>{{ $booking->remark}} </td>
					</tr>
					@if ($booking->return_flight == "Yes")
						<tr>
							<th>-------------</th>
						</tr>
						<tr>
							<th>Return flight</th>
						</tr>
						<tr>
							<th>-------------</th>
						</tr>
						<tr> 
							<th>Flight no</th>
							<td>{{ $returnbooking->flight_no_on_return }} </td>
						</tr>
						<tr> 
							<th>Date time</th>
							<td>{{ $returnbooking->pickup_date}} {{ $returnbooking->pickup_time}}</td>
						</tr>
						<tr> 
							<th>Remarks</th>
							<td>{{ $returnbooking->remark}} </td>
						</tr>
					@endif
				</table>
				<!--<button onclick="confirmAction(true)">Ok</button>-->
			</div>
		</div>
	</div>
	
	
    <script>
        setTimeout(function() {
            window.location.href = "https://www.spl.taxi";
        }, 15000); // Redirect na 15 seconden   
		
		function openConfirmDialog(name, date, time, pickup, house_from, destination, house_to) {
		// Vul de dialoog met gegevens
		var details = 'Name: ' + name + '<br>' +
					  'Date: ' + date + '<br>' +
					  'Time: ' + time + '<br>' +
					  'Pickup: ' + pickup + ' ' + house_from + '<br>' +
					  'Destination: ' + destination + ' ' + house_to;
		document.getElementById('dialog-details').innerHTML = details;

		// Toon het aangepaste dialoogvenster
		document.getElementById('booking-message-dialog').style.display = 'flex';
		}

		function confirmAction(isConfirmed) {
			if (isConfirmed) {
				// Verberg het aangepaste dialoogvenster
				document.getElementById('booking-message-dialog').style.display = 'none';
				window.location.href = "https://www.spl.taxi";
			} 		
		}

    </script>
</body>
</html>