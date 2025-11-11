<style>
	.table {
		width: 65%;
		table-layout: fixed;
	}

	.table td {
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}

	.table input {
		width: 100%;
		max-width: 100%;
		box-sizing: border-box;
		-webkit-appearance: none; /* mobiel safari */
		appearance: none;
}
</style>
<div class="container table-responsive">
	<form id="copy-booking-form" action="{{ route('bookings.adminstore') }}" method="POST">
		@csrf
		<input type="hidden" id="id" name="id" value="{{ $booking->id }}">
		<table class="table table-responsive-lg table-bordered" border="1">
			<colgroup>
				<col style="width:30%">
				<col style="width:70%">
			</colgroup>
			<thead>
				<th colspan="2" class="form-control" ><button type="submit" class="btn btn-red">Copy booking</button></th>
			</thead>
			<tr>
				<td><b>Date</b></td>
				<td colspan="1"> 
					<input type="date" value="{{ $booking->pickup_date }}" id="datepicker" required name="pickup_date"
										class="form-control datepicker">
				</td>
			</tr>
			<tr>
				<td><b>Time</b></td>
				<td>
					<input type="time" value="{{ $booking->pickup_time }}" required name="pickup_time" placeholder="HH:mm"
										class="form-control">
				</td>
			</tr>
			<tr>
				<td><b>From</b></td>
				<td colspan="1"><input type="text" value="{{ $booking->pickup_address }}" required class="form-control pg-autocomplete"
									   value="" name="pickup_address" placeholder="Enter From"></td>
			
			</tr>
			<tr>
				<td></td>
				<td><input type="text" value="{{ $booking->house_no_from }}"
									   value="{{ $booking->house_no_from }}" required 	class="form-control" value=""
									   name="house_no_from" placeholder="House/Flight No"></td>			
			</tr>
			<tr>
				<td><b>To</b></td>
				<td colspan="1"><input type="text" class="form-control pg-autocomplete" id="to" value="{{ $booking->destination }}"
									   name="to" required value="Schiphol" placeholder="Enter Destination"></td>
			</tr>
			<tr id="schiphol">
				<td></td>
				<td colspan="1"><input type="text" required class="form-control" id="house_to" value="{{ $booking->house_no_to }}"
									   name="house_no_to" value="-" placeholder="House No."></td>

			</tr>
			<tr>
				<td><b>Price Customer</b></td>
				<td>				
					<input type="text" name="price" id="price" class="form-control" value="{{ $booking->price }}" >
				</td>
			</tr>
			<tr>
				<td><b>Price Taxi></b></td>
				<td><input type="text" name="price1" id="price1" value="{{ $booking->price1 }}" class="form-control">
				</td>
			</tr>
			<tr>
				<td><b>Mode</b></td>
				<td style="width:12%">
					<select name="mode" id="mode" class="form-control">
						<option value="Cash" @if ($booking->mode === 'Cash') selected @endif>Cash</option>
						<option value="On Account" @if ($booking->mode === 'On Account') selected @endif>On Account</option>
						<option value="Pin Payment" @if ($booking->mode === 'Pin Payment') selected @endif>Pin Payment</option>
						<option value="Credit Card" @if ($booking->mode === 'Credit Card') selected @endif>Credit Card</option>				
						<option value="Remittance" @if ($booking->mode === 'Remittance') selected @endif>Remittance</option>
						<option value="No Payment" @if ($booking->mode === 'No Payment') selected @endif>No Payment</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Company</b></td>
				<td colspan="1">
					<select  name="company" id="company" >
						<option value="" class="form-control" >Choose a company</option>
						@foreach($companies as $company)
						<option value="{{ $company->naam }}" @if ($booking->company === $company->naam ) selected @endif>{{ $company->naam }}</option>
						@endforeach
					</select>
				</td>
			</tr>

			<tr>
				<td><b>Mobile</b></td>
				<td colspan="1"><input type="text" class="form-control" id="mobile" name="mobile" value="{{ $booking->phone }}"
									   placeholder="Enter Mobile Number"></td>
			</tr>
			<tr>
				<td><b>Name</b></td>
				<td colspan="1"><input type="text" name="uname" id="uname" class="form-control" value="{{ $booking->name }}"
									   placeholder="Enter Your Name"></td>			
			</tr>
			<tr>
				<td><b>Person(s)</b></td>
				<td colspan="1"><input type="text" class="form-control" name="press" id="press" value="{{ $booking->press }}"
									   placeholder="Enter No of Passenger"></td>
			</tr>
			<tr>
				<td><b>Luggage</b></td>
				<td colspan="1"><input type="text" name="luggage" id="luggage" class="" value="Luggage" value="{{ $booking->luggage }}"
									   placeholder="Enter No of Luggage"></td>
			</tr>
			<tr>
				<td><b>Vehicle</b></td>
				<td colspan="1"><select class="" name="vehicle" id="vehicle">
					<option value="Sedan" @if ($booking->vehicle === 'Sedan') selected @endif>Sedan</option>
					<option value="Stationwagen" @if ($booking->vehicle === 'Stationwagen') selected @endif>Stationwagen</option>
					<option value="Bus4" @if ($booking->vehicle === 'Bus4') selected @endif>>Bus4</option>
					<option value="Bus5" @if ($booking->vehicle === 'Bus5') selected @endif>Bus5</option>
					<option value="Bus6" @if ($booking->vehicle === 'Bus6') selected @endif>Bus6</option>
					<option value="Bus7" @if ($booking->vehicle === 'Bus7') selected @endif>Bus7</option>
					<option value="Bus8" @if ($booking->vehicle === 'Bus8') selected @endif>Bus8</option>
					</select></td>
			</tr>
			<tr>
				<td><b>Remark</b></td>
				<td colspan="1">
					<textarea class="form-control" name="remark" cols="10" id="remark" placeholder="Enter Remark" 
							  value="{{ $booking->remark }}"></textarea>
				</td>
			</tr>
			<tr>
				<td rowspan="1"><b>Return</b></td>
				<td colspan="1">
  					<select class="" name="return" id="choice-copy">
						<option value="No">No</option>
						<option value="Yes">Yes</option>
					</select>
				</td>
			</tr>
			<tr class="retshow">
				<td><b>Date</b></td>
				<td colspan="1">
					<input class="" type="date" name="flight_date"
									   id="flight_date" placeholder="" >
				</td>
			</tr>
			<tr class="retshow">
				<td><b>Time</b></td>
				<td>
					<input type="time" name="flight_time" id="flight_time"
									   class="">
				</td>
			</tr>
			<tr class="retshow">
				<td><b>Flight No</b></td>
				<td>
					<input class="" type="text" name="flight_no" id="flight_no"
													   placeholder="Flight No">
				</td>
			</tr>
			<tr  class="retshow">
				<td><b>Return Remark</b></td>
				<td colspan="2">
					<textarea class="form-control" name="returnremark" id="returnremark" placeholder="Enter Return Remark"></textarea>
				</td>
			</tr>
			<tr>
				<td><b>Driver</b></td>
				<td colspan="2">
					<select class="" id="driver" name="driver_id">
						<option value="" class="" >Choose a driver</option>
						@foreach ($drivers as $driver)
							<option value="{{ $driver->id }}">{{ $driver->name }}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td><b>E-mail</b></td>
				<td colspan="1"><input type="email" class="" name="email" id="email" value="{{ $booking->email }}"
									   placeholder="Enter E-mail"></td>
			</tr>
		</table>
		<style>
			.rethide{
				display:none;
			}

		</style>
		<br />
		<div class="row" >
			<div>
				<button class="btn btn-primary"><a href="{{ url('/admin/bookings') }}" style="color:white;">Cancel</a></button>
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</div>	

	</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script async
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete">
   
        // Get the select element and input fields
        const choiceSelect = document.getElementById('choice');
        const input1 = document.getElementById('flight_date');
        const input2 = document.getElementById('flight_time');
        const input3 = document.getElementById('flight_no');

        // Function to enable/disable and set required attribute
        function toggleInputValidation() {
			var shouldEnable = false;
            const selectedValue = choiceSelect.value;
            if (selectedValue === 'Yes') {
                input1.disabled = false;
                input2.disabled = false;
                input3.disabled = false;
                input1.required = true;
                input2.required = true;
                input3.required = true;
				shouldEnable = true;
            } else {
                input1.disabled = true;
                input2.disabled = true;
                input3.disabled = true;
                input1.required = false;
                input2.required = false;
                input3.required = false;
                input1.value = '';
                input2.value = '';
                input3.value = '';
				shouldEnable = false;
            }
			
			const rethideSections = document.querySelectorAll('.rethide, .retshow');
			rethideSections.forEach(section => {
				if (shouldEnable) {
					section.classList.remove('rethide');
					section.classList.add('retshow');
				} else {
					section.classList.remove('retshow');
					section.classList.add('rethide');
				}
			});
        }

        // Add event listener to the select element
        //choiceSelect.addEventListener('change', toggleInputValidation);
		//document.getElementById('choice-copy').addEventListener('change', toggleInputValidation);
		$('#choice-copy').on('change', toggleInputValidation);

		function test(){
			alert("oke");
		}
	
        // Trigger the function when the page is fully loaded
        document.addEventListener('DOMContentLoaded', toggleInputValidation);
    
        function initAutocomplete() {
			document.addEventListener('DOMContentLoaded', function () {
				var options = {
					fields: ["formatted_address", "geometry", "name", "address_components", "icon"],
				};
				var inputs = document.getElementsByClassName('pg-autocomplete');
				for (var i = 0; i < inputs.length; i++) {
					new google.maps.places.Autocomplete(inputs[i], options);
				}
				document.querySelector(".pg-track-location").addEventListener("click", function() {
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					}
				});
			}
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({
                'latLng': latLng
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        document.getElementsByClassName('pg-autocomplete')[0].value = results[0].formatted_address;
                    }
                }
            });
        }

			
	

</script>
