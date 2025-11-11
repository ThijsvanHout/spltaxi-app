<head>
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
    }

    .form-container {
        flex: 1;
        padding: 20px;
    }

    .table-container {
        flex: 1;
        padding: 20px;
    }

    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1;
        overflow: auto;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .modal-header {
        padding: 10px;
        background-color: #f2f2f2;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Modal Header Style */
    .modal-header h2 {
        margin: 0;
    }

	/* test thijs */
	.driver-filter {
		display: none
	}

    table {

        border-collapse: collapse;
        font-family: Arial;
        font-size: 16px;
    }

    tbody tr:nth-child(odd) {
        background-color: #ffffff;
        /* Light gray for odd rows */
    }

    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
        /* White for even rows */
    }

    tbody td {
        width: 30%;
        text-align: center;
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

    .btn-grad:hover {
        background-position: right center;
        color: #DD0000;
        text-decoration: none;
    }

    .btn-grads {
        background-color: #DD0000;
        margin: 10px;
        /* padding: 15px 15px; */
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }

    a {
        text-decoration-line: none;
    }

    .btn-grads:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }


    select {
        background-color: #008CBA;
        color: white;
        border: none;
        padding: 10px 20px;
        margin: 5px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
    }

    select:hover {
        background-color: #005b8f;
    }





    tr:nth-child(even) {
        background-color: #ddd;
    }

    tr:nth-child(odd) {
        background-color: #f2f2f2;
    }


    tr:hover {
        background-color: #ccc;
    }

    input,
    textarea {
        /* width: 100%; */
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
		min-width: 140px;
		
    }


    input,
    textarea:focus {
        border-color: #007bff;
        outline: none;
    }

	.dropbtn {
		background-color: #DD0000;
		color: white;
		padding: 10px;
		font-size: 14px;
		border: none;
		cursor: pointer;
		
		margin: 10px;
        padding: 15px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
       
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
	}

	/* Style the dropdown content (hidden by default) */
	.dropdown-content {
		
		position: absolute;
		background-color: #DD0000;
		min-width: 160px;
		box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
		z-index: 1;
	}	

    
    #book {
  display: flex;
  flex-direction: column; /* To stack elements vertically */
  justify-content: left; /* To vertically center the element */
  align-items: left; /* To horizontally center the element */

  /* Mobile view */
  width: 85%;
  margin-left: auto;
  margin-right: auto;
}

/* Desktop view */
@media (min-width: 768px) {
    #book {
    width: 75%;
    margin-left: 75%;
  }
}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('main-section')
	@php
		$bookingsCopy = json_decode(json_encode($bookings), true);	
	@endphp

	@if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <br>
    <center><a href="{{ url('/admin') }}" class="brand-link" style="background: #fff;">
            <img src="{{ asset('images/logo.png') }}" class="brand-image" style="opacity: .8; float: none;">
        </a></center>


    <div class="container">


        <!-- Table Container -->
        <div class="table-container">
            <h2>Booking List</h2>&nbsp;
            <div class="buttons-spl" style="display:flex;">
                <a href="{{ url('/admin') }}"><button class="btn-grad">Back To Home</button></a>
                <a href="{{ url('/admin/bookings') }}"><button class="btn-grad">New Bookings</button></a>
				<a href="{{ route('completedbookings') }}"><button class="btn-grad">All drivers</button></a>
				
				<form action="{{ route('bookings-filter') }}" method="POST" id="filterForm">
					@csrf
					<select name="chauffeur" id="chauffeur" class="dropbtn">
						<option value="" class="dropdown-content" >Choose a driver</option>
						@foreach($drivers as $driver)
							<option value="{{ $driver->id }}">{{ $driver->name }}</option>
						@endforeach
					</select>

					<!--<button type="submit" class="btn-grad">Filter</button>-->
				</form>



				<!--<select  id="driver-filter"  class="btn-grad"> 
					<option value="">Selecteer een chauffeur</option>
					@foreach($drivers as $driver)
						<option value="{{ $driver->name }}">{{ $driver->name }}</option>
					@endforeach
					
				</select>-->
				
         	</div>


            {{-- {{ $bookings }} --}}
			

            <table id="example5" class="" border="1" style="width: 150%;">
                <thead>
                    <tr style="background-color:#DD0000; color: #FFFFFF; font-weight:bold">
                        <th>Day Date & Time</th>
                        <th width="">From House No. & Destination House No.</th>
                        <th width="">Mobile</th>
                        <th width="">Name</th>
                        <th>No. of Passengers</th>
                        <th width="">Price</th>
                        <th width="">Vehicle Type</th>
                        <th width="">Driver</th>
                        <th>Status</th>
                        <th width="">Remarks</th>
                        <th width="">Email</th>
                        <th>Return Date & Time</th>


						<th>Flight No</th>







                        <th>Luggage</th>


                        <th>Invoice</th>
                        <th>Actions</th>
                        <th>Driver Link</th>
                        <th>User Link</th>
                    </tr>
                </thead>
                <tbody>					
                    @foreach ($bookings as $booking)
                        @php
                            $pickupDate = \Carbon\Carbon::parse($booking->pickup_date);
                            $return = \Carbon\Carbon::parse($booking->return_pickup_date);
                            
                        @endphp

                        <tr>
                            <td
                                style="width: 10% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                <b> {{ $pickupDate->format('D') }}&nbsp; {{ $pickupDate->format('d-m-Y') }}
                                </b>&nbsp;&nbsp;<br>
                                <hr>{{ $booking->pickup_time }}
                            </td>
                            <td
                                style="width: 12% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                <b>{{ $booking->pickup_address ?? '' }}</b> &nbsp; <b>{{ $booking->house_no_from ?? '' }}</b>
                                <br>
                                <hr> {{ $booking->destination ?? '' }} &nbsp; <b>{{ $booking->house_no_to ?? '' }}</b>
                            </td>
                            <td
                                style="width: 8% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->phone }}</td>
                            <td
                                style="width: 8% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->name }}</td>
                            <td
                                style="width: 8% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->press }}</td>
                            <td
                                style="width: 6% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                <b>{{ $booking->price }}</b>
                                <hr>{{ $booking->price1 }}
                                <hr>{{ $booking->mode }}
                            </td>
                            <td
                                style="width: 5% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->vehicle ?? '' }}
                            </td>
                            <td
                                style="width: 8% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                <font color="#008000">{{ $booking->driver_name ?? '' }}</font> &nbsp;<br>
                            </td>
                            <td
                                style="width: 5% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->status }}</td>
                            <td
                                style="width: 5% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->remark }}</td>
                            <td
                                style="width: 6% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->email }}</td>
                            <td
                                style="width: 12% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                @php
                                    if ($booking->return_flight == 'Yes') {
                                        echo '<b>' . $return->format('D') . '</b><br>';
                                        echo '<b>' . $return->format('d-m-Y') . '</b>';
                                        echo ' ';
                                        echo '<b>' . $booking->time_return_flight . '</b><br><hr>';
                                        echo '<b>' . $booking->flight_no_on_return . '</b>';
                                    } else {
                                        echo '<b>No</b>';
                                    }
                                @endphp





                            </td>


                            <td>{{ $booking->flight_no_on_return }}</td>


                            <td
                                style="width: 3% !important; 
                            padding: 10px; 
                            border: 1px solid #ccc;">
                                {{ $booking->luggage }}</td>

                            <td>{{ $booking->invoice }}</td>





                            <td class="d-flex">
                          
                         
                                @if (($booking->status == 'pending' && $booking->assign_id == '') || $booking->status == 'Rejected')
                                    <button type="button" class="btn-grads btn-block bg-gradient-primary assign-btn myBtn"
                                        data-toggle="modal" data-id="{{ $booking->id }}"
                                        data-target="#assignDriverModal">Assign</button>
                                @else
                                    <button type="button" disabled
                                        class="btn-grads btn-block bg-gradient-primary assign-btn" data-toggle="modal"
                                        data-id="{{ $booking->id }}" data-target="#assignDriverModal">Assigned</button>
                                @endif
                                
                                <button type="button" class="btn-grads btn-block bg-gradient-primary complete-ride-btn" data-id="{{ $booking->id }}">Complete</button>
								<!--<a href="" class="btn-grads btn-default btn-icon button"><i class="fas fa-edit"
							            data-toggle="modal" data-id="{{ $booking->id }}"
                                        data-target="#copyModal">Copy</i></a>-->
								
								<a href="{{ url('/admin/bookings/' . $booking->id . '/copy2') }}"
                                    class="btn-grads btn-default btn-icon button"><i class="fas fa-edit">Copy</i></a>
                                <a href="{{ url('/admin/bookings/' . $booking->id . '/edit') }}"
                                    class="btn-grads btn-default btn-icon button"><i class="fas fa-edit">Edit</i></a>
                                <form method="POST" action="{{ url('/admin/bookings/' . $booking->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-grads btn-default btn-icon button ml-1"
                                        onclick="return confirm('Are you sure you want to delete this record?')">
                                        <i class="fas fa-trash">Delete</i>
                                    </button>
                                </form>
	
                          
                            </td>
                            <td>
                                @if ($booking->assign_id != '')
                                    <a href="{{ url('/driver-confirmation', $booking->assign_id) }}">Confirmation
                                        Link 1</a>
                                @endif
                            </td>
                            <td>
                                @if ($booking->assign_id != '' && $booking->status == 'Accepted')
                                    <a href="{{ url('/user-confirmation', $booking->assign_id) }}">Confirmation
                                        Link 2</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
					
                </tbody>
            </table>

			include('layouts/copybookings');
            <!--</table>-->
        </div>


        <!-- Form Container -->
        <div class="form-container" id="book" style="margin-top: 90px; width:100%;">
            <h2>Add Booking</h2>


             <form id="add-booking-form" method="POST" action="{{ route('bookings.store') }}">
                @csrf
                <table class="table table-responsive table-bordered" border="1">
                    <tr>
                        <td><b>Date, Time </b></td>
                        <td colspan="2"> <input type="date" id="datepicker" required name="pickup_date"
                                class=" datepicker"></td>
                        <td colspan="1"> <input type="time" required name="pickup_time" placeholder="HH:mm"
                                class=""></td>
                        
                    </tr>
                  
                    <tr>
                        <td><b>From</b></td>
                        <td colspan="2"><input type="text" required class="form-control pg-autocomplete"
                                value="" name="pickup_address" placeholder="Enter From"></td>
                        <td colspan="1"><input type="text" required class="form-control" value=""
                                name="house_no_from" placeholder="House No"></td>

                    </tr>
                    <tr>
                        <td><b>To</b></td>
                        <td colspan="2"><input type="text" class="form-control pg-autocomplete" id="to"
                                name="to" required placeholder="Enter Destination"></td>
                        <td colspan="1"><input type="text" required class="form-control" id="house_to"
                                name="house_no_to" placeholder=" House No."></td>

                    </tr>
                    <tr>
                        <td  rowspan="1"><b>Price (Customer,Taxi)</b></td>
                        <td><input type="text" name="price" id="price" class="">
                        </td>
                        <td><input type="text" name="price1" id="price1" class="">
                        </td>
                        <td style="width:12%"><select name="mode" id="mode" class="">
                                <option value="Cash">Cash</option>
                                <option value="On Account">On Account</option>
                                <option value="Pin Payment">Pin Payment</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Master Card">Master Card</option>
                                <option value="American Express">American Express</option>
                                <option value="Remittance">Remittance</option>
                                <option value="No Payment">No Payment</option>
                            </select></td>
                       
                    </tr>
              
                    <tr>
                        <td><b>Mobile, E-mail, Name</b></td>
                        <td colspan="1"><input type="text" class="" id="mobile" name="mobile"
                                placeholder="Enter Mobile Number"></td>
                        <td colspan="1"><input type="email" class="" name="email" id="email"
                                placeholder="Enter E-mail"></td>
                        <td colspan="1"><input type="text" required name="uname" id="uname" class=""
                                placeholder="Enter Your Name"></td>
                    </tr>
					  <tr>
                        <td><b>Person(s), Luggage, Vehicle</b></td>
                        <td colspan="1"><input type="text" class="" name="press" id="press"
                                placeholder="Enter No of Passenger"></td>
                        <td colspan="1"><input type="text" name="luggage" id="luggage" class=""
                                placeholder="Enter No of Luggage"></td>
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
                        <td colspan="3">
                            <textarea class="" name="remark" id="remark" placeholder="Enter Remark"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="1"><b>Return</b></td>
                        <td colspan="1"><select class="form-control" name="return" id="choice">
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>

                            </select></td>

                        <td colspan="2" class="rethide"><input class="form-control" type="text" name="flight_no" id="flight_no"
                                placeholder="Flight No"></td>

                       
                    </tr>
                    <tr class="rethide">
						<td rowspan="1"><b>Date/Time</b></td>
                    <td colspan="2"><input class="form-control" type="date" name="flight_date"
                                id="flight_date" placeholder="" ></td>
                        <td colspan="1"><input type="time" name="flight_time" id="flight_time"
                                class="form-control"></td>
                    </tr>
                    <tr  class="rethide">
                        <td><b>Return Remark</b></td>
                        <td colspan="3">
                            <textarea class="" name="returnremark" id="returnremark" placeholder="Enter Return Remark"></textarea>
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
                        <button type="submit" class="btn-grad">Add</button>
                    </div>
                </div>

            </form>
        </div>
    </div>



    <!-- Assign Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content modal-large">
            <div class="modal-header">
                <h5 class="modal-title" id="assignDriverModalLabel">Assign Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="close">&times;</span>
                </button>
            </div>

            <div id="modalContent">

                <form id="assignDriverForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="driver">Driver</label>
                            <select class="" id="driver" name="driver_id">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="csrf_token" id="csrf_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="booking_id" name="booking_id" value="" readonly />
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}

                        <button type="submit" id="assignDriverButton" class="btn-grad">Assign Driver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

 <!-- Copy Modal -->
    <!-- modal.blade.php -->
	<div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
					<button type="button"   aria-label="Close">
						<!--<span aria-hidden="true">&times;</span>-->
					</button>
				</div>
				<div class="modal-body">
					<!-- Modal content goes here -->
					Your modal content goes here.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" >Close</button>
					<!-- Additional buttons if needed -->
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>



    <script>
        // Get all elements with class "myBtn" (all buttons with the class)
        var buttons = document.querySelectorAll(".myBtn");

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When any button is clicked, open the modal with the corresponding data-id
        buttons.forEach(function(button) {
            button.onclick = function() {
                var dataId = this.getAttribute("data-id");
                document.getElementById("booking_id").value =
                    dataId; // Set the data-id value in the input field
                modal.style.display = "block";
            }
        });

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl5y2ApdvxYPlUKgXQnO7SdaYExoxA-AQ&libraries=places&callback=initAutocomplete">
    </script>

	


    {{-- 

<!-- Main content -->
<section class="content" id="zaid">
    <div class="">
        <div class="row">
            <div class="">
                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example5" class="" border="1">
                            <thead>

                                <tr>
                                    <th>Sr</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone/Mobile</th>
                                    <th>Pickup Date</th>
                                    <th>Pickup Time</th>
                                    <th>Pickup Address</th>
                                    <th>No of Persons</th>
                                    <th>Status</th>

                                    <th>Destination</th>
                                    <th>To1</th>
                                    <th>Return Flight</th>
                                    <th>Return Flight No</th>
                                    <th>Return Flight Date</th>
                                    <th>Press</th>
                                    <th>Luggage</th>
                                    <th>Vehicle</th>
                                    <th>Price</th>
                                    <th>Price1</th>
                                    <th>Transaction Mode</th>
                                    <th>Km</th>
                                    <th>Min</th>
                                    <th>Customer</th>
                                    <th>Invoice</th>
                                    <th>Taxi</th>
                                    <th>Remark</th>
                                    <th>Actions</th>
                                    <th>Driver Link</th>
                                    <th>User Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>{{ $booking->email }}</td>
                                        <td>{{ $booking->phone }}</td>
                                        <td>{{ $booking->pickup_date }}</td>
                                        <td>{{ $booking->pickup_time }}</td>
                                        <td>{{ $booking->pickup_address }}</td>
                                        <td>{{ $booking->no_of_persons }}</td>
                                        <td>{{ $booking->status }}</td>
                                        <td>{{ $booking->destination }}</td>
                                        <td>{{ $booking->to1 }}</td>
                                        <td>{{ $booking->return_flight }}</td>
                                        <td>{{ $booking->flight_no_on_return }}</td>
                                        <td>{{ $booking->date_return_flight }}</td>
                                        <td>{{ $booking->press }}</td>
                                        <td>{{ $booking->luggage }}</td>
                                        <td>{{ $booking->vehicle }}</td>
                                        <td>{{ $booking->price }}</td>
                                        <td>{{ $booking->price1 }}</td>
                                        <td>{{ $booking->mode }}</td>
                                        <td>{{ $booking->km }}</td>
                                        <td>{{ $booking->min }}</td>
                                        <td>{{ $booking->customer }}</td>
                                        <td>{{ $booking->invoice }}</td>
                                        <td>{{ $booking->taxi }}</td>
                                        <td>{{ $booking->remark }}</td>



                                        <td class="d-flex">
                                            @if (($booking->status == 'pending' && $booking->assign_id == '') || $booking->status == 'Rejected')
                                                <button type="button"
                                                    class="btn btn-block bg-gradient-primary assign-btn"
                                                    data-toggle="modal" data-id="{{ $booking->id }}"
                                                    data-target="#assignDriverModal">Assign</button>
                                            @else
                                                <button type="button" disabled
                                                    class="btn btn-block bg-gradient-primary assign-btn"
                                                    data-toggle="modal" data-id="{{ $booking->id }}"
                                                    data-target="#assignDriverModal">Assigned</button>
                                            @endif
											<!--<a href="" class="btn-grads btn-default btn-icon button"><i class="fas fa-edit"
							            data-toggle="modal" data-id="{{ $booking->id }}"
                                        data-target="#copyModal">Copy</i></a>-->
								
											<a href="{{ url('/admin/bookings/' . $booking->id . '/copy2') }}"
                                    class="btn-grads btn-default btn-icon button"><i class="fas fa-edit">Copy</i></a>

                                            <a href="{{ url('/admin/bookings/' . $booking->id . '/edit') }}"
                                                class="btn btn-default btn-icon button"><i
                                                    class="fas fa-edit">Edit</i></a>
                                            <form method="POST"
                                                action="{{ url('/admin/bookings/' . $booking->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-default btn-icon button ml-1"
                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                    <i class="fas fa-trash">Delete</i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            @if ($booking->assign_id != '')
                                                <a href="{{ url('/driver-confirmation', $booking->assign_id) }}">Confirmation
                                                    Link 1</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($booking->assign_id != '' && $booking->status == 'Accepted')
                                                <a href="{{ url('/user-confirmation', $booking->assign_id) }}">Confirmation
                                                    Link 2</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->



            <div class="col-md-6 col-sm-12 right-side">

                <div class="card card-primary">

                    <!-- form start -->


                    <!-- form start -->
                    <form id="add-booking-form" method="POST" action="{{ route('bookings.store') }}">
                        @csrf

                        <table class="table table-responsive table-bordered">
                            <tr>
                                <td><b>Date, Time </b></td>
                                <td colspan="2"> <input type="date" id="datepicker" required
                                        name="pickup_date" class=" datepicker"></td>
                                <td colspan="2"> <input type="time" required name="pickup_time"
                                        placeholder="HH:mm" class=""></td>
                                <td colspan=""> <input type="checkbox" name="check" class=""
                                        value="option">&nbsp;<label> Options</label></td>
                            </tr>
                            <tr>
                                <td><b>Press, Luggage, Vehicle</b></td>
                                <td><input type="text" class="" name="press" id="press"
                                        placeholder="Enter No of Passenger"></td>
                                <td colspan="2"><input type="text" name="luggage" id="luggage"
                                        class="" placeholder="Enter No of Luggage"></td>
                                <td colspan="2"><select class="" name="vehicle" id="vehicle">
                                        <option value="Sedan">Sedan</option>
                                        <option value="No">No</option>
                                        <option value="Station">Station</option>
                                        <option value="Bus5">Bus5</option>
                                        <option value="Bus6">Bus6</option>
                                        <option value="Bus7">Bus7</option>
                                        <option value="Bus8">Bus8</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td><b>From</b></td>
                                <td colspan="5"><input type="text" class=" pg-autocomplete" required
                                        value="" name="pickup_address" placeholder="Enter From"></td>

                            </tr>
                            <tr>
                                <td><b>To</b></td>
                                <td colspan="5"><input type="text" class=" pg-autocomplete" id="to"
                                        name="to" placeholder="Enter Destination"></td>

                            </tr>
                            <tr>
                                <td><b>Price (Customer,Taxi)</b></td>
                                <td><input type="text" name="price" id="price" class="">
                                </td>
                                <td><input type="text" name="price1" id="price1" class="">
                                </td>
                                <td style="width:12%"><select name="mode" id="mode" class="">
                                        <option value="Cash">Cash</option>
                                        <option value="On Account">On Account</option>
                                        <option value="Pin Payment">Pin Payment</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Master Card">Master Card</option>
                                        <option value="American Express">American Express</option>
                                        <option value="Remittance">Remittance</option>
                                        <option value="No Payment">No Payment</option>
                                    </select></td>
                                <td><input type="text" name="km" id="km" placeholder="KM"
                                        class="">
                                </td>
                                <td><input type="text" name="min" id="min" placeholder="Min"
                                        class="">
                                </td>
                            </tr>
                            <tr>
                                <td><b>Mobile, E-mail, Name</b></td>
                                <td colspan="1"><input type="text" class="" id="mobile"
                                        name="mobile" placeholder="Enter Mobile Number"></td>
                                <td colspan="2"><input type="email" class="" name="email"
                                        id="email" placeholder="Enter E-mail"></td>
                                <td colspan="2"><input type="text" required name="uname" id="uname"
                                        class="" placeholder="Enter Your Name"></td>
                            </tr>
                            <tr>
                                <td><b>Customer</b></td>
                                <td colspan="5"><input type="text" name="customer" id="customer"
                                        class=""></td>
                            </tr>
                            <tr>
                                <td><b>Invoice</b></td>
                                <td colspan="5"><input type="text" name="invoice" id="invoice"
                                        class=""></td>
                            </tr>
                            <tr>
                                <td><b>Taxi</b></td>
                                <td colspan="5"><input type="text" name="taxi" id="taxi"
                                        class=""></td>
                            </tr>
                            <tr>
                                <td><b>Return</b></td>
                                <td><select class="" name="return" id="choice">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>

                                    </select></td>
                                <td colspan="2"><input class="" type="date" name="flight_date"
                                        id="flight_date" placeholder="Flight No"></td>
                                <td colspan="3"><input type="time" name="flight_time" id="flight_time"
                                        class=""></td>
                            </tr>
                            <tr>
                                <td><b>Remark</b></td>
                                <td colspan="5">
                                    <textarea class="" name="remark" id="remark" placeholder="Enter Remark"></textarea>
                                </td>
                            </tr>

                        </table>

                        <div class="row">
                            <div class="col-lg-12" align="right">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>



                </div>

            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- /.container-fluid -->
</section> --}}
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    {{-- <div class="modal fade" id="assignDriverModal" tabindex="-1" role="dialog"
        aria-labelledby="assignDriverModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignDriverModalLabel">Assign Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="assignDriverForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="driver">Driver</label>
                            <select class="" id="driver" name="driver_id">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="booking_id" name="booking_id" value="1" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Assign Driver</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}



    {{-- <script>
    const modal = document.getElementById("myModal");
    const openModalBtn = document.getElementById("openModalBtn");

    // Function to open the modal
    function openModal() {
        modal.style.display = "block";
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Add a click event listener to the button
    openModalBtn.addEventListener("click", openModal);
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Find all elements with the class 'assign-btn'
        
        var assignButtons = document.querySelectorAll('.assign-btn');

        // Add a click event listener to each assign button
        assignButtons.forEach(function(button) {
            button.addEventListener('click', function() {
              // alert("Zaid");
                // Get the data-id attribute value
                var bookingId = this.getAttribute('data-id');
                console.log(bookingId, "=====wewewew");

                // Find the booking_id input field in the modal and set its value
                var bookingIdInput = document.querySelector('#assignDriverModal #booking_id');
                if (bookingIdInput) {
                    bookingIdInput.value = bookingId;
                }
            });
        });
    });
</script> --}}

    {{-- <script>
        $('#assignDriverForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin/assign-driver') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    window.location.reload();
                    // Close the modal
                    $('#myModal').modal('hide');
                    if (response.message == "Driver assigned successfully") {
                        window.location.reload();
                    }
                    // Show a success message or refresh the page
                    // alert(url);
                }
            });
        });
    </script> --}}

    <script>
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
            var options = {
                fields: ["formatted_address", "geometry", "name", "address_components", "icon"],
            };
            var inputs = document.getElementsByClassName('pg-autocomplete');
			//var inputs =$(".pg-autocomplete"
            for (var i = 0; i < inputs.length; i++) {
                new google.maps.places.Autocomplete(inputs[i], options);
            }
            document.querySelector(".pg-track-location").addEventListener("click", function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
            });
			/*$(".pg-track-location").on("click", function() {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				}
			}); */

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


    <script>

document.addEventListener("DOMContentLoaded", function() {
    var completeRideButtons = document.querySelectorAll('.complete-ride-btn');
    
    completeRideButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var bookingId = this.getAttribute('data-id');

            // Confirmation popup
            var userConfirmation = window.confirm('Are you sure you want to complete this ride?');

            if (userConfirmation) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin/bookingStatus') }}', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content')); // Assuming you have a meta tag for csrf-token

                xhr.onload = function() {
                    if (this.status === 200) {
                        var response = JSON.parse(this.responseText);
                        if (response.success) {
                            alert('Ride completed successfully!');
                        } else {
                            alert('Error completing the ride.');
                        }
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                };

                var params = 'booking_id=' + bookingId;
                xhr.send(params);
            }
        });
    });
});




        document.getElementById('assignDriverForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get the form data
            var formData = new FormData(this);

            // Add the CSRF token field to the form data
            formData.append('csrf_token', document.getElementById('csrf_token').value);

            // Log the form data (for demonstration purposes)
            for (var pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            var xhr = new XMLHttpRequest();

            xhr.open('POST', '{{ route('admin/assign-driver') }}', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    window.location.reload();
                    // Close the modal
                    var modal = document.getElementById('myModal');
                    modal.style.display = 'none';
                    if (response.message === 'Driver assigned successfully') {
                        window.location.reload();
                    }
                    // Show a success message or refresh the page
                    // alert(url);
                }
            };

            xhr.send(formData);
        });
    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.assign-btn').on('click', function() {
                var bookingId = $(this).data('id');
                console.log(bookingId, "=====wewewew")
                $('#myModal #booking_id').val(bookingId);
            });
        });
</script>

<script>
	$('#chauffeur').change(function() {
            $('#filterForm').submit();
        });
</script>

@section('footer-scripts')

@endsection
