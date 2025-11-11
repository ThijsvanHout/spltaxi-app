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
	<form id="return-booking" action="{{ route('bookings.adminstore') }}" method="POST">
		@csrf
		<!--<input type="hidden" id="id" name="id" value="{{ $booking->id }}">-->
		<table class="table table-responsive-lg table-bordered" border="1">
			<colgroup>
				<col style="width:30%">
				<col style="width:70%">
			</colgroup>
			<thead>
				
					<th colspan="2" class="text-center align-middle" >
						<div>
							<button type="submit" class="btn btn-red">Return booking</button>
						</div>
				</th>
				
			</thead>
			<tr>
				<td><b>Date</b></td>
				<td colspan="1"> 
					<input type="date" value="{{ $booking->pickup_date }}" id="datepicker"
						   required name="pickup_date" class="form-control datepicker">
				</td>
			</tr>
			<tr>
				<td><b>Time</b></td>
				<td> 
					<input type="time" value="{{ $booking->pickup_time }}" required
						   name="pickup_time" placeholder="HH:mm" class="form-control">
				</td>                      
			</tr>
			<tr>
				<td><b>From</b></td>
				<td colspan="1">
					<input type="text" value="{{ $booking->destination }}"
						   class="form-control pg-autocomplete" required   name="pickup_address"
						   placeholder="Enter From">
				</td>
			</tr>
			<tr>
				<td></td>				
				<td colspan="1">
					@if ((strpos(strtolower($booking->destination), 'schiphol') !== false))	
						<input type="text" value="Flight" 
									   placeholder="To House From " class="form-control"
						   				name="house_no_from" id="from1">
					@else
						<input type="text" 
							   value="{{ ($booking->house_no_to === '-' || $booking->house_no_to === null) ? '-' : $booking->house_no_to }}" 
							   placeholder="To House From " class="form-control"
							   name="house_no_from" id="from1">
					@endif
			</tr>
			<tr>
				<td><b>To</b></td>
				<td colspan="1">
					<input type="text" value="{{ $booking->pickup_address }}"
						   class="form-control pg-autocomplete" id="to" name="to"
						   placeholder="Enter Destination">
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="1">						
						@if ((strpos(strtolower($booking->pickup_address), 'schiphol') !== false))	
					
							<input type="text" value="Flight " placeholder="To House No " class="form-control"
						   		   name="house_no_to" id="to1">
						@else
							<input type="text" 
								   value="{{ ($booking->house_no_from === '-' || $booking->house_no_from === null) ? 'House No ' : $booking->house_no_from }}" 					
								   placeholder="To House No " class="form-control"
								   name="house_no_to" id="to1">							
						@endif
				</td>
			</tr>
			<tr>
				<td><b>Price Customer</b></td>
				<td>
					<div class="input-group mb-2">
						<input type="text" name="price" value="{{ $booking->price }}" id="price" class="form-control">				
					</div>						
				</td>
			</tr>
			<tr>
				<td><b>Price Taxi</b></td>
				<td>
					<input type="text" name="price1" value="{{ $booking->price1 }}" id="price1"
						   class="form-control">
				</td>
			</tr>
			<tr>
				<td><b>Mode</b></td>
				<td style="width:12%"><select name="mode" id="mode" class="form-control">
					<option value="Cash" @if ($booking->mode === 'Cash') selected @endif>Cash</option>
					<option value="On Account" @if ($booking->mode === 'On Account') selected @endif>On Account
					</option>
					<option value="Pin Payment" @if ($booking->mode === 'Pin Payment') selected @endif>Pin Payment
					</option>
					<option value="Credit Card" @if ($booking->mode === 'Credit Card') selected @endif>Credit Card
					</option>                                
					<option value="Remittance" @if ($booking->mode === 'Remittance') selected @endif>Remittance
					</option>
					<option value="No Payment" @if ($booking->mode === 'No Payment') selected @endif>No Payment
					</option>
					</select>
				</td> 
			</tr>
			<tr>
				<td><b>Company</b></td>
				<td colspan="1">
					<select class="select-driver" name="company" id="company" >
						<option value="" class="" >Choose a company</option>
						@foreach($companies as $company)
						<option value="{{ $company->naam }}">{{ $company->naam }}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td><b>Mobile</b></td>
				<td colspan="1">
					<input type="text"  value="{{ $booking->phone }}"
						   class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number">
				</td>
			</tr>
			<tr>
				<td><b>Name</b></td>
				<td colspan="1">
					<input type="text" required name="uname" value="{{ $booking->name }}"
						   id="uname" class="form-control" placeholder="Enter Your Name">
				</td>
			</tr>
			<tr>
				<td><b>Person(s)</b></td>
				<td>
					<input type="text" value="{{ $booking->press }}"  class="form-control" name="press"
						   id="press" placeholder="Enter No of Passenger">
				</td>
			</tr>
			<tr>
				<td><b>Luggage</b></td>
				<td colspan="1">
					<input type="text"  value="{{ $booking->luggage }}" name="luggage"
						   id="luggage" class="form-control" placeholder="Enter No of Luggage">
				</td>
			</tr>
			<tr>
				<td><b>Vehicle</b></td>
				<td colspan="1"><select class="form-control" name="vehicle" id="vehicle">
					<option value="Sedan" @if ($booking->vehicle === 'Sedan') selected @endif>Sedan</option>
					<option value="Stationwagen" @if ($booking->vehicle === 'Stationwagen') selected @endif>Stationwagen</option>
					<option value="Bus4" @if ($booking->vehicle === 'Bus4') selected @endif>Bus4</option>
					<option value="Bus5" @if ($booking->vehicle === 'Bus5') selected @endif>Bus5</option>
					<option value="Bus6" @if ($booking->vehicle === 'Bus6') selected @endif>Bus6</option>
					<option value="Bus7" @if ($booking->vehicle === 'Bus7') selected @endif>Bus7</option>
					<option value="Bus8" @if ($booking->vehicle === 'Bus8') selected @endif>Bus8</option>
					</select></td>
			</tr>
			<tr>
				<td><b>Remark</b></td>
				<td colspan="1">
					<textarea class="form-control" value="{{ $booking->remark }}" name="remark" cols="10" id="remark"
							  placeholder="Enter Remark">{{ $booking->remark }}</textarea>
				</td>
			</tr>
			<tr>
				<td><b>Driver</b></td>
				<td colspan="1">
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
				<td colspan="1">
					<input type="email"  value="{{ $booking->email }}"
						   class="form-control" name="email" id="email" placeholder="Enter E-mail">
				</td>
			</tr>
			<td><input class="form-control" name="return" id="choice" value="No" hidden></td>

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
				<button type="submit" class="btn btn-primary">Add</button>
			</div>
		</div>
	</form>
</div>
<script async
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete">
   
        // Get the select element and input fields
        const choiceSelect = document.getElementById('choice');
        const input1 = document.getElementById('flight_date');
        const input2 = document.getElementById('flight_time');
        const input3 = document.getElementById('flight_no');

        // Function to enable/disable and set required attribute
        function toggleInputValidation() {

            const selectedValue = choiceSelect.value;
            if (selectedValue === 'Yes') {
                input1.disabled = false;
                input2.disabled = false;
                input3.disabled = false;
                input1.required = true;
                input2.required = true;
                input3.required = true;
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
            }

        }

        // Add event listener to the select element
        choiceSelect.addEventListener('change', toggleInputValidation);

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

