@extends('layouts.app')


@section('main-section')
    <style>
        /* Add custom styles for the form */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        .form-row {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
		
		.btn-grad {
			background-color: #DD0000;
			margin: 10px;
			padding: 15px 45px;
			text-align: center;
			text-transform: uppercase;
			transition: 0.5s;
			background-size: 200% auto;
			color: white;
			box-shadow: 0 0 20px #eee;
			border-radius: 10px;
			display: block;
		}
		
        /* Style the select dropdown */
        .select-dropdown {
            position: relative;
        }

        .select-dropdown:after {
            content: "\f078";
            font-family: "Font Awesome 5 Free";
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Add some space for the FontAwesome icon */
        .select-dropdown select {
            padding-right: 30px;
        }

        /* Make the select dropdown arrow clickable */
        .select-dropdown select::-ms-expand {
            display: none;
        }

        .select-dropdown select option {
            padding: 5px 10px;
        }

        /* Style the well background */
        .well {
            background-color: #f3f3f3;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        
    </style>


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0">Copy Booking</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Copy Details of {{ $booking->name }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

		
        <div class="container table-responsive">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <!--<input type="hidden" id="id" name="id" value="{{ $booking->id }}">-->




                <table class="table table-responsive table-bordered">
                    <tr>
                        <td><b>Date, Time </b></td>
                        <td colspan="2"> <input type="date" value="{{ $booking->pickup_date }}" id="datepicker"
                                required name="pickup_date" class="form-control datepicker"></td>
                        <td colspan="3"> <input type="time" value="{{ $booking->pickup_time }}" required
                                name="pickup_time" placeholder="HH:mm" class="form-control"></td>
                      
                    </tr>
                    <tr>
                        <td><b>Person(s), Luggage, Vehicle</b></td>
                        <td><input type="text" value="{{ $booking->press }}"  class="form-control" name="press"
                                id="press" placeholder="Enter No of Passenger"></td>
                        <td colspan="2"><input type="text"  value="{{ $booking->luggage }}" name="luggage"
                                id="luggage" class="form-control" placeholder="Enter No of Luggage"></td>
                        <td colspan="2"><select class="form-control" name="vehicle" id="vehicle">
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
                        <td><b>From</b></td>
                        <td colspan="2"><input type="text" value="{{ $booking->pickup_address }}"
                                class="form-control pg-autocomplete" required   name="pickup_address"
                                placeholder="Enter From"></td>
                        <td colspan="3"><input type="text" value="{{ $booking->house_no_from }}" placeholder="From House No"  class="form-control"
                                name="house_no_from" id="from1">
                        </td>
                    </tr>
                    <tr>
                        <td><b>To</b></td>
                        <td colspan="2"><input type="text" value="{{ $booking->destination }}"
                                class="form-control pg-autocomplete" id="to" name="to"
                                placeholder="Enter Destination"></td>
                        <td colspan="3"><input type="text" value="{{ $booking->house_no_to }}" placeholder="To House No " class="form-control"
                                name="house_no_to" id="to1">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Price (Customer,Taxi)</b></td>
                        <td>												
						  	<div class="input-group mb-2">
									<div class="input-group-prepend">
									  <div class="input-group-text"><i class="fa-solid fa-euro-sign"></i></div>
									</div>
									  <input type="text" name="price" value="{{ $booking->price }}" id="price"
                                class="form-control">								
							</div>						
						</td>
                        <td><input type="text" name="price1" value="{{ $booking->price1 }}" id="price1"
                                class="form-control"></td>
                        <td style="width:20%"><select name="mode" id="mode" class="form-control">
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
                            </select></td>
                       
                    </tr>
					
                    <tr>
                        <td><b>Mobile, E-mail</b></td>
                        <td colspan="1"><input type="text"  value="{{ $booking->phone }}"
                                class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number">
                        </td>
                        <td colspan="2"><input type="email"  value="{{ $booking->email }}"
                                class="form-control" name="email" id="email" placeholder="Enter E-mail"></td>
                        <td colspan="2"><input type="text" required name="uname" value="{{ $booking->name }}"
                                id="uname" class="form-control" placeholder="Enter Your Name"></td>
                    </tr>
					<tr>
						<td><b>Name, Company</b></td>
                        <td colspan="2"><input type="text" required name="uname" value="{{ $booking->name }}"
                                id="uname" class="form-control" placeholder="Enter Your Name"></td>
						<td colspan="1">
							<select class="select-driver" name="company" id="company" >
									<option value="" class="" >Choose a company</option>
									@foreach($companies as $company)
									<option value="{{ $company->naam }}">{{ $company->naam }}</option>
									@endforeach
							</select>
						</td>
					{{--	<td colspan="2"><select name="company" id="company" class="">
							<option value="-">-</option>
							<option value="Easy Rider" @if ($booking->company === 'Easy Rider') selected @endif>Easy Rider</option>
							<option value="Massive Music" @if ($booking->company === 'Massive Music') selected @endif>Massive Music</option>
							<option value="TCA" @if ($booking->company === 'TCA') selected @endif>TCA </option>
							<option value="Hans Brouwer Prive" @if ($booking->company === 'Hans Brouwer Prive') selected @endif>Hans Brouwer Prive</option>
							<option value="Joep Beving Sonderling b.v." @if ($booking->company === 'Joep Beving Sonderling b.v.') selected @endif>Joep Beving Sonderling b.v. </option>
							<option value="Stichting Holland Festival" @if ($booking->company === 'Stichting Holland Festival') selected @endif>Stichting Holland Festival</option>
							<option value="Wiser Globe" @if ($booking->company === 'Wiser Globe') selected @endif>Wiser Globe</option>
							<option value="Politie" @if ($booking->company === 'Politie') selected @endif>Politie</option>
							<option value="Kevlinx Holding BV" @if ($booking->company === 'Kevlinx Holding BV') selected @endif>Kevlinx Holding BV </option>
							<option value="Stichting Flamenco Biënnale" @if ($booking->company === 'Stichting Flamenco Biënnale') selected @endif>Stichting Flamenco Biënnale </option>
							<option value="Safar Limo Service" @if ($booking->company === 'Safar Limo Service') selected @endif>Safar Limo Service</option>
							<option value="Vereniging Hoge Scholen" @if ($booking->company === 'Vereniging Hoge Scholen') selected @endif>Vereniging Hoge Scholen</option>
							<option value="The Recess College" @if ($booking->company === 'The Recess College') selected @endif>The Recess College</option>
							</select></td>--}}
                    </tr>
                    {{-- <tr>
                        <td><b>Customer</b></td>
                        <td colspan="5"><input type="text" value="{{ $booking->customer }}" name="customer"
                                id="customer" class="form-control"></td>
                    </tr> --}}
                   
             
                    <tr>
                        <td><b>Remark</b></td>
                        <td colspan="5">
                            <textarea class="form-control" value="{{ $booking->remark }}" name="remark" id="remark"
                                placeholder="Enter Remark">{{ $booking->remark }}</textarea>
                        </td>
                    </tr>
					
					<tr>
                        <td rowspan="1"><b>Return</b></td>
                        <td colspan="1"><select class="form-control" name="return" id="choice-copy">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>

                            </select></td>

                        {{--<td colspan="2" class="rethide"><input class="form-control" type="text" name="flight_no" id="flight_no"
                                placeholder="Flight No"></td>--}}

                       
                    </tr>
                    <tr class="rethide">
						<td rowspan="1"><b>Date/Time</b></td>
                    <td colspan="2"><input class="form-control" type="date"   name="flight_date"
                                id="flight_date" placeholder="" ></td>
                        <td colspan="1"><input type="time" name="flight_time" id="flight_time"
                                class="form-control"></td>
						<td colspan-"1"><input class="form-control" type="text" name="flight_no" id="flight_no"
											   placeholder="Flight No"></td>
                    </tr>
                    <tr  class="rethide">
                        <td><b>Return Remark</b></td>
                        <td colspan="3">
                            <textarea class="form-control" name="returnremark" id="returnremark" placeholder="Enter Return Remark">								</textarea>
                        </td>
                    </tr>

                </table>
				<style>
						.rethide{
							display:none;
						}
						
				</style>
                <div class="row">
                    <div class="col-lg-12" align="right">
						<a href="{{ url('/admin/bookings') }}" class="btn btn-primary">Cancel</a>						
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>



                



            </form>

        </div>



    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->


   <!-- <script async
       src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl5y2ApdvxYPlUKgXQnO7SdaYExoxA-AQ&libraries=places&callback=initAutocomplete">
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete">
    </script> -->
	<script async
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete">
	</script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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

        // Add event listener to the select element
        //choiceSelect.addEventListener('change', toggleInputValidation);
		
		



        // Trigger the function when the page is fully loaded
        document.addEventListener('DOMContentLoaded', toggleInputValidation);
    </script>

	<script>
		$(document).ready(function() {			
			$('#choice-copy').change(function(){
				alert("hoeera");
				var returnFlight = $('#choice').val();
								
				if (returnFlight ===  'No') {
					$('.rethide').hide();
				}
				else if (returnFlight ===  'Yes') {
					$('.rethide').show();
				}
			});
		});
	</script>


    <script>
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
@endsection
