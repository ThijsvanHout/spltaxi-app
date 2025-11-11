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

<div class="container table-responsive" >
	<form id="add-booking-form" action="{{ route('bookings.adminstore') }}" method="POST">
		@csrf
		<!--<input type="hidden" id="id" name="id" value="{{ $booking->id }}">-->
		<table class="table table-responsive-lg table-bordered" border="1" >
			<colgroup>
				<col style="width:30%">
				<col style="width:70%">
			</colgroup>
			<thead>
				<th colspan="2" class="text-center align-middle" ><button type="submit" class="btn btn-red">Add booking</button></th>
			</thead>
			<tr>
				<td><b>Date </b></td>
				<td> 
					<input type="date" id="datepicker" required name="pickup_date" value="{{ now()->toDateString('dd-mm-yyyy') }}"
										class=" datepicker">
				</td>
			</tr>
			<tr>
				<td><b>Time </b></td>
				<td>
					<input type="time" required name="pickup_time" placeholder="HH:mm"
										class="">
				</td>
			</tr>

			<tr>
				<td><b>From</b></td>
				<td colspan="1"><input type="text" required class="form-control pg-autocomplete"
									   value="" name="pickup_address" placeholder="Enter From"></td>
			
			</tr>
			<tr>
				<td><b>House no</b></td>
				<td colspan="1"><input type="text" class="form-control" value="House no "
									   name="house_no_from" placeholder="House No"></td>				
			</tr>
			<tr>
				<td><b>Flight no</b></td>
				<td colspan="1"><input type="text" class="form-control" value="Flight "
									   name="flight_no" placeholder="Flight No"></td>
			</tr>
			<tr>
				<td><b>To</b></td>
				<td colspan="1"><input type="text" class="form-control pg-autocomplete" id="to"
									   name="to" required value="Schiphol" placeholder="Enter Destination"></td>
			</tr>
			<tr id="schiphol">
				<td><b>House no</b></td>
				<td colspan="1"><input type="text" required class="form-control" id="house_to"
									   name="house_no_to" value="House no " placeholder="House No "></td>
			</tr>
			<tr id="schiphol">
				<td><b>Flight no</b></td>
				<td colspan="1"><input type="text" required class="form-control" id="house_to"
									   name="house_no_to" value="Flight " placeholder="Flight No."></td>
			</tr>
			
			<tr>
				<td><b>Price Customer</b></td>
				<td>				
					<input type="text" name="price" id="price" class="form-control" value="€ ">
				</td>
			</tr>
			<tr>
				<td><b>Price Taxi</b></td>
				<td><input type="text" name="price1" id="price1" value="Code €" class="form-control">
				</td>
			</tr>
			<tr>
				<td><b>Mode</b></td>
				<td style="width:12%">
					<select name="mode" id="mode" class="">
						<option value="Cash">Cash</option>
						<option value="On Account">On Account</option>
						<option value="Pin Payment" selected>Pin Payment</option>
						<option value="Credit Card">Credit Card</option>					
						<option value="Remittance">Remittance</option>
						<option value="No Payment">No Payment</option>
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
				<td colspan="1"><input type="text" class="form-control" id="mobile" name="mobile"
									   placeholder="Enter Mobile Number"></td>
			</tr>
			<tr>
				<td><b>Name</b></td>
				<td colspan="1"><input type="text" name="uname" id="uname" class="form-control"
									   placeholder="Enter Your Name"></td>
				
			{{--	<td colspan="1"><select name="company" id="company" class="">
					<option value=""></option>
					<option value="Easy Rider">Easy Rider</option>
					<option value="Massive Music">Massive Music</option>
					<option value="TCA">TCA</option>
					<option value="Hans Brouwer Prive">Hans Brouwer Prive</option>					
					<option value="Joep Beving Sonderling b.v.">Joep Beving Sonderling b.v. </option>
					<option value="Stichting Holland Festival">Stichting Holland Festival</option>
					<option value="Wiser Globe">Wiser Globe</option>
					<option value="Politie">Politie</option>
					<option value="Kevlinx Holding BV">Kevlinx Holding BV </option>
					<option value="Stichting Flamenco Biënnale">Stichting Flamenco Biënnale </option>
					<option value="Safar Limo Service">Safar Limo Service</option>
					<option value="Vereniging Hoge Scholen">Vereniging Hoge Scholen</option>
					<option value="The Recess College">The Recess College</option>
					</select></td> --}}
			</tr>
			<tr>
				<td><b>Person(s)</b></td>
				<td colspan="1"><input type="text" class="form-control" name="press" id="press" value="Pax "
									   placeholder="Enter No of Passenger"></td>
			</tr>
			<tr>
				<td><b>Luggage</b></td>
				<td colspan="1"><input type="text" name="luggage" id="luggage" class="" value="Luggage "
									   placeholder="Enter No of Luggage"></td>
			</tr>
			<tr>
				<td><b>Vehicle</b></td>
				<td colspan="1"><select class="" name="vehicle" id="vehicle">
					<option value="Sedan">Sedan</option>
					<option value="Stationwagen">Stationwagen</option>
					<option value="Bus4">Bus4</option>
					<option value="Bus5">Bus5</option>
					<option value="Bus6">Bus6</option>
					<option value="Bus7">Bus7</option>
					<option value="Bus8">Bus8</option>
					</select></td>
			</tr>
			{{-- <tr>
			<td><b>Customer</b></td>
			<td colspan="5"><input type="text" name="customer" id="customer" class=""></td>
			</tr> --}}
			<tr>
				<td><b>Remark</b></td>
				<td colspan="2">
					<textarea class="form-control" name="remark" cols="10" id="remark" placeholder="Enter Remark"></textarea>
				</td>
			</tr>
			<tr>
				<td rowspan="1"><b>Return</b></td>
				<td colspan="1"><select class="" name="return" id="choice">
					<option value="No">No</option>
					<option value="Yes">Yes</option>

					</select></td>

				{{--<td colspan="2" class="rethide"><input class="" type="text" name="flight_no" id="flight_no"
													   placeholder="Flight No"></td> --}}


			</tr>
			<tr class="rethide">
				<td><b>Date</b></td>
				<td colspan="1">
					<input class="" type="date" name="flight_date"
									   id="flight_date" placeholder="" >
				</td>
			</tr>
			<tr class="rethide">
				<td><b>Time</b></td>
				<td colspan="1">
					<input type="time" name="flight_time" id="flight_time"
									   class="">
				</td>
			</tr>
			<tr class="rethide">
				<td><b>Flight no</b></td>
				<td colspan="1">
					<input class="form-control" type="text" name="flight_no_on_return" id="flight_no_on_return" value="Flight "
													   placeholder="">
				</td>
				{{--<td colspan="1"></td> --}}
			</tr>
			<tr  class="rethide">
				<td><b>Return Remark</b></td>
				<td colspan="1">
					<textarea class="form-control" name="returnremark" id="returnremark" placeholder="Enter Return Remark"></textarea>
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
				<td colspan="1"><input type="email" class="" name="email" id="email"
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
				<button type="submit" class="btn btn-primary">Add</button>
			</div>
		</div>	

	</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl5y2ApdvxYPlUKgXQnO7SdaYExoxA-AQ&libraries=places&callback=initAutocomplete"></script> -->
<script>
        // Get the select element and input fields
        const choiceSelect = document.getElementById('choice');
		if (!choiceSelect) {
			choiceSelect = document.getElementById('choice-copy');
		}
        const input1 = document.getElementById('flight_date');
        const input2 = document.getElementById('flight_time');
        const input3 = document.getElementById('flight_no');
		const input4 = document.getElementById('returnremark');

        // Function to enable/disable and set required attribute
        function toggleInputValidation() {
			var shouldEnable = false;
            const selectedValue = choiceSelect.value;
            if (selectedValue === 'Yes') {				
                input1.disabled = false;
                input2.disabled = false;
                input3.disabled = false;
				input4.disabled = false;
                input1.required = true;
                input2.required = true;
                input3.required = true;
				input3.value = 'Flight ';
				shouldEnable = true;
            } else {
                input1.disabled = true;
                input2.disabled = true;
                input3.disabled = true;
				input4.disabled = true;
                input1.required = false;
                input2.required = false;
                input3.required = false;
                input1.value = '';
                input2.value = '';
                input3.value = 'Flight';
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
        choiceSelect.addEventListener('change', function(){
			if (!input3.value.trim()) {
				input3.value = 'Flight ';
			}
			toggleInputValidation();
		});
		
        // Trigger the function when the page is fully loaded
        document.addEventListener('DOMContentLoaded', function(){
			if (!input3.value.trim()) {
				input3.value = 'Flight ';
			}
			toggleInputValidation();
		});
			


     
	function initAutocomplete() { 
		document.addEventListener('DOMContentLoaded', function () {
			var options = {
				fields: ["formatted_address", "geometry", "name", "address_components", "icon"],
			};
			
			const inputs = document.getElementsByClassName('pg-autocomplete');
			
			for (var i = 0; i < inputs.length; i++) {
				// Alleen een nieuwe Autocomplete aanmaken als er nog geen is
				if (!inputs[i].autocompleteInstance) {
					inputs[i].autocompleteInstance = new google.maps.places.Autocomplete(inputs[i], options);

					// Listener koppelen aan deze instantie
					inputs[i].autocompleteInstance.addListener("place_changed", function() {
						var place = this.getPlace();
						console.log("Gekozen adres:", place.formatted_address);

						// Schiphol check
						if (place.formatted_address.includes('Schiphol')) {
							document.getElementById('house-to').style.display = 'none';
						} else {
							document.getElementById('house-to').style.display = 'block';
						}

						// Trigger manueel change event
						var event = new Event('change');
						this.input.dispatchEvent(event);
					});

					// Koppel de input zelf aan de autocomplete voor gebruik in listener
					inputs[i].autocompleteInstance.input = inputs[i];
				}
				/*new google.maps.places.Autocomplete(inputs[i], options);
				
				autocomplete.addListener("place_changed", function () {
				const place = autocomplete.getPlace();
				alert(place);
				// Voorbeeld: log de gekozen straat of adres
				console.log("Gekozen adres:", place.formatted_address);

				// Je kunt ook een hidden input invullen of andere acties doen
				// input.dataset.selected = "true"; // bijv. markeren dat er gekozen is
				}); */
			}
			document.querySelector(".pg-track-location").addEventListener("click", function() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				}
			});						
		}
	}


/*	function initAutocompleteTEST() {
		console.log("initAutocomplete gestart");

		// Wacht tot DOM geladen is, dan pas inputs selecteren
		if (document.readyState === "loading") {
			document.addEventListener('DOMContentLoaded', setupAutocomplete);
		} else {
			setupAutocomplete();
		}
	}

	function setupAutocompleteTEST() {
		var options = {
			fields: ["formatted_address", "geometry", "name", "address_components"],
		};
		var inputs = document.getElementsByClassName('pg-autocomplete');
		console.log("Aantal inputvelden gevonden:", inputs.length);

		for (var i = 0; i < inputs.length; i++) {
			let input = inputs[i];
			let autocomplete = new google.maps.places.Autocomplete(input, options);

			autocomplete.addListener("place_changed", function () {
				const place = autocomplete.getPlace();
				console.log("Gekozen adres:", place.formatted_address);
			});
		}
	} */
	
/*	function showPosition(position) {
	  var lat = position.coords.latitude;
	  var lng = position.coords.longitude;
	  var geocoder = new google.maps.Geocoder();
	  var latLng = new google.maps.LatLng(lat, lng);
	  geocoder.geocode({ 'latLng': latLng }, function (results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
		  if (results[0]) {
			document.getElementsByClassName('pg-autocomplete')[0].value = results[0].formatted_address;
		  }
		}
	  });
	}
*/

    // Gebruik jQuery om het document klaar te maken
    $(document).ready(function(){
	
        // Voeg een eventlistener toe aan het inputveld
        /*$('#to').on('input', function(){
            // Haal de ingevoerde waarde op
            var ingevoerdeWaarde = $(this).val();
			console.log(ingevoerdeWaarde);
            // Controleer of de ingevoerde waarde "Schiphol" bevat
            if (ingevoerdeWaarde.toLowerCase().indexOf('schiphol') !== -1) {
                $("#house_to").hide();
            } else {				
				$("#house_to").show();
                // Voer hier verdere acties uit als de waarde "Schiphol" niet bevat
            }
        });*/
		
		
		var adresTo = document.getElementById('to');
		adresTo.addEventListener('change', houseNrHide);
		function houseNrHide() {
			var ingevoerdeWaarde = $('#to').val();
			if (ingevoerdeWaarde.toLowerCase().indexOf('schiphol') !== -1) {			
                $("#house_to").hide();
            } else {				
				$("#house_to").show();
                // Voer hier verdere acties uit als de waarde "Schiphol" niet bevat
            }
		}
    });
</script> 
	