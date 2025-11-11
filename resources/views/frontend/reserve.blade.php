@extends('frontend.index')

<?php
	session_start();

	// Genereer een willekeurige rekensom
	$nummer1 = rand(1, 10);
	$nummer2 = rand(1, 10);
	$_SESSION['captcha_antwoord'] = $nummer1 + $nummer2;
?>

@section('main-section')
    <section class="overon-sec">
		
        <div class="container">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form id="booking-form" method="post" action="{{ route('bookings.store') }}">
                @csrf
                <div class="row">
                    {{-- <div class="col-lg-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Pickup-Date<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-6">
                                <input type="date" id="datepicker" required name="pickup_date" class="form-control datepicker">
                            </div>
                        </div>                     
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Pickup Time<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-6">
                                <input type="time" required name="pickup_time" placeholder="HH:mm" class="form-control">
                            </div>
                        </div>                     
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Phone/Mobile<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-6">
                                <input type="tel" required name="phone" required placeholder="Phone/Mobile Number" class="form-control">
                            </div>
                        </div>                     
                    </div>
                    <div class="form-group mt-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Pickup Address<span class="text-danger">*</span></label>
                                <input type="text" required value="{{ $dataReceived }}" name="pickup_address" placeholder="Street Name + Nr. + City" class="form-control pg-autocomplete">
                            </div>
                            <div class="col-lg-6">
                                <label>House Nr.<span class="text-danger">*</span></label>
                                <input type="text" required name="house_no" placeholder="House/Flight Nr." class="form-control">
                            </div>
                        </div>                     
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Destination</label>
                                <div>
                                    <!-- <input type="checkbox" name="destination" placeholder="streetname + nr + city" class="mr-2"> -->
                                    <input type="text" readonly value="Schiphol Airport" name="destination" class="form-control" class="mr-2">
                                    
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3">
                                <label>Your Return Flight</label>
                                <div><input id="return-flight" name="return_flight" type="checkbox" placeholder="streetname + nr + city" class="mr-2"> Yes I'd like to be picked up on return</div>
                            </div>
                        </div>                     
                    </div>
                    <div id="return-flight-info" style="display: none;">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Flight nr on return</label>
                                    <input type="text" name="flight_no_on_return" id="flight_no_on_return" placeholder="Flight nr on return" class="form-control">
                                </div>
                            </div>                     
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Date Return Flight</label>
                                    <input type="date" data-date-format="DD/MM/YYYY" placeholder="Date Return Flight" class="form-control" name="date_return_flight" id="date_return_flight">
                                </div>
                            </div>                     
                        </div>
                    </div>
                </div> --}}
                    {{-- <div class="col-lg-6">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Nr. of persons<span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <div class="">
                                        <input type="text" required name="no_of_persons" placeholder="Nr. of persons" class="form-control">
                                    </div>
                                    <!-- <div class="">
                                        <button class="btn bg-light">People</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>                     
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Name<span class="text-danger">*</span></label>
                                <input type="text" required name="name" placeholder="Name" class="form-control">
                            </div>
                        </div>                     
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="text" required name="email" placeholder="Email Address" class="form-control">
                            </div>
                        </div>                     
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Optional Comments </label>
                                <textarea class="form-control" name="optional_comment" placeholder="Comments"></textarea>
                            </div>
                        </div>                     
                    </div>
                </div> --}}
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td><b>Date, Time </b></td>
                            <td colspan="2"> <input type="date" id="datepicker" required min="<?php echo date("Y-m-d"); ?>" name="pickup_date"
                                    class="form-control datepicker"></td>
                            <td colspan="3"> <input type="time" required name="pickup_time" placeholder="HH:mm"
                                    class="form-control"></td>
                            
                        </tr>
                      
                        <tr>
                            <td><b>From</b></td>
                            <td colspan="3"><input type="text" required class="form-control pg-autocomplete"
                                    value="{{ $dataReceived }}" name="pickup_address" placeholder="Enter From"></td>
                            <td colspan="2"><input type="text" class="form-control"
                                    value="" required name="house_no_from" placeholder="House/Flight No"></td>

                        </tr>
                        <tr>
                            <td><b>To</b></td>
                            <td colspan="3"><input type="text" class="form-control pg-autocomplete" id="to"
                                    name="to" required value="Schiphol" placeholder="Enter Destination"></td>
                            <td colspan="2"><input type="text" class="form-control" id="house_to"
                                    name="house_no_to" required value="-" placeholder=" House No."></td>

                        </tr>
                        <tr>
                            <td><b>Mode of Payment</b></td>
                           
                            <td colspan="3"><select name="mode" id="mode" class="form-control">
                                    <option value="Cash">Cash</option>
                                    <option value="On Account">On Account</option>
                                    <option value="Pin Payment" selected>Pin Payment</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Master Card">Master Card</option>
                                    <option value="American Express">American Express</option>
                                    <option value="Remittance">Remittance</option>
                                    <option value="No Payment">No Payment</option>
                                </select></td>
                           
                        </tr>
                        <tr>
                            <td><b>Mobile, E-mail, Name</b></td>
                            <td colspan="1"><input type="text" class="form-control" required id="mobile" name="mobile"
                                    placeholder="Enter Mobile Number"></td>
                            <td colspan="2"><input type="email" class="form-control" required name="email" id="email"
                                    placeholder="Enter E-mail"></td>
                            <td colspan="2"><input type="text" required name="uname" id="uname"
                                    class="form-control" placeholder="Enter Your Name"></td>
                        </tr>
						
						  <tr>
                            <td><b>Person(s), Luggage, Vehicle</b></td>
                            <td><input type="text" required class="form-control" name="press" id="press"
                                    placeholder="Enter No of Passenger"></td>
                            <td colspan="2"><input required type="text" name="luggage" id="luggage" class="form-control"
                                    placeholder="Enter No of Luggage"></td>
                            <td colspan="2"><select class="form-control" name="vehicle" id="vehicle">
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
                            <td colspan="5"><input type="text" name="customer" id="customer"
                                    class="form-control"></td>
                        </tr> --}}
                        <tr>
                            <td><b>Remark</b></td>
                            <td colspan="5">
                                <textarea class="form-control" name="remark" id="remark" placeholder="Enter Remark"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Return, Flight, Date, Time</b></td>
                            <td><select class="form-control" name="return" id="choice">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>

                                </select></td>

                            <td class="rethide" colspan="2"><input class="form-control" type="text" name="flight_no"
                                    id="flight_no" placeholder="Flight No"></td>

                            <td class="rethide" colspan="1"><input class="form-control" type="date" name="flight_date"
                                    id="flight_date"  min="<?php echo date("Y-m-d"); ?>" placeholder=""></td>
                            <td class="rethide" colspan="1"><input type="time" name="flight_time" id="flight_time"
                                    class="form-control"></td>
                        </tr>
                        <tr class="rethide" >
                            <td><b>Return Remark</b></td>
                            <td colspan="5">
                                <textarea class="form-control" name="returnremark" id="returnremark" placeholder="Enter Return Remark"></textarea>
                            </td>
                        </tr>

                    </table>
					<style>
						.rethide{
							display:none;
						}
						
					</style>
                </div>
                <div class="row">
					<!-- Dynamische CAPTCHA -->
					<div class="pr-2">Wat is <?php echo $nummer1 . " + " . $nummer2; ?> ? </div>
					<input type="text" class="pl-2" id="captcha" name="captcha" required>
					
                    <div class="pl-4" >
                        <button id="add-button" type="submit" class="btn btn-primary" 
								 >Add</button>
                    </div>
                </div>
            </form>
        </div>
    </section>



<!-- Modal (Optioneel) -->
    <div id="successModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Succes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>De boeking is succesvol opgeslagen!</p>
                    <p id="booking-info"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

	
    <script>
			
        // Get the select element and input fields
        const choiceSelect = document.getElementById('choice');
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
        choiceSelect.addEventListener('change', toggleInputValidation);

        // Trigger the function when the page is fully loaded
        document.addEventListener('DOMContentLoaded', toggleInputValidation);
		
		function confirmAdd(name, date, time, pickup, house_from, destination, house_to) {
            var message = 'Are you sure you want to delete this record?\n\n' +
                          'Name: ' + name + '\n' +
                          'Date: ' + date + '\n' +
						  'Time: ' + time + '\n' +
				          'Pickup: ' + pickup + ' ' + house_from + '\n' +
				          'Destination: ' + destination + ' ' + house_to;
            return confirm(message);     
		}
		
		

    </script>

@endsection
