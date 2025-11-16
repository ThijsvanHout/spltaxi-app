
<head>
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" >
</head>

<style>
	.booktable td{
		white-space: nowrap;
	}
	.booktable td.nowrap{
	white-space: normal;
	}
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
    }

    #booking-buttons {
        position: sticky;
        top: 0; /* blijft plakken zodra je scrollt naar de tabel */
        background: white;
        z-index: 10;
        padding: 10px 0;
    }

    /* Tabel header sticky onder de knoppen */
    

    
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

	.header-container {
        display: flex;
        justify-content: flex-end; /* Zorgt ervoor dat alles naar rechts gaat */
        align-items: center; /* Verticaal gecentreerd */
        padding: 10px;
    }

    .header-container .item {
        margin-left: 20px; /* Ruimte tussen de items */
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

   /* tbody td {
        width: 30%;
        text-align: center;
    } */
	
	.btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

	.btn-white {
		color:white !important;
	}
	
	.btn-red {
		background-color: #DD0000;	
		color: #fff;
		border: none;
		border-radius: 5px;
		padding: 10px 20px;
		cursor: pointer;
        padding: 15px 45px; 
        text-align: center;
        text-transform: uppercase;
		/*width:100%;*/
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
        padding: 15px 15px;
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
	
	td {
    padding: 5px;
	}

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
		min-width: 140px;
		max-width :100%;
    }


    input,
    textarea:focus {
        border-color: #007bff;
        outline: none;
    }

	/* drodpwon action */
	.dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
			left:0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Stijl voor de knop en dropdown-opties */
        .dropdown button {
            background-color: #DD0000;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
			text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }
	
		.no-border-btn {
				/*background: none !important;*/
				border: none !important!;
			background-color: transparent !important;
        margin: 0px 8px;
        /*padding: 15px 15px;*/
        font-size:17px !important;
        
        transition: 0.5s;
        background-size: 200% auto;
        color: black !important;
        /*box-shadow: 0 0 20px #eee;*/
        border-radius: 10px;
        display: block;
			text-align :left;
			
				
			}
    	/* einde dropdown action */
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
        margin-left: 30px;    
    }
    .table-container table thead tr {
        top: 90px; /* iPhone / smaller screen */
    }
}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('main-section')

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
	
	<div class="header-container">
		<!-- Welkomstbericht -->
		<div class="item">
			@if (Auth::guard('admin')->check())
				<p class="mb-0">Welcome, {{ Auth::guard('admin')->user()->name }}</p>
			@endif
		</div>

		<!-- Logout knop -->
		<div class="item">
			<form method="POST" action="{{ route('admin.logout') }}">
				@csrf
				<button class="btn btn-primary" type="submit" name="logout">Logout</button>
			</form>
		</div>
	</div>


    <br>
    <center><a href="{{ url('/admin') }}" class="brand-link" style="background: #fff;">
            <img src="{{ asset('images/logo.png') }}" class="brand-image" style="opacity: .8; float: none;">
        </a></center>


    <div class="container">
		

        <!-- Table Container -->
        <div class="table-container">
            <h2>Active Bookings</h2>&nbsp;
            <div class="buttons-spl" id="booking-buttons" style="display:flex;" >
				@if (Auth::guard('admin')->check()) 
					@if (Auth::guard('admin')->user()->role === "Admin")
						<a class="mr-4" href="{{ url('/admin') }}" style="font-size:45px;padding : 10px 0px 10px 0px; color:red;">
							<i class="bi bi-house-door-fill" ></i>
						</a>
						<!--<a  href="{{ url('/admin/bookings/create') }}"  style="font-size:45px;padding : 10px 0px 10px 0px; margin-right:25px;" >
							<i class="bi bi-plus-lg" ></i>
						</a>-->
						<a  href="" id="add-booking" style="font-size:45px;padding : 10px 0px 10px 0px; margin-right:25px;" >
							<i class="bi bi-plus-lg" ></i>
						</a>
					@endif
				@endif
                <!--<a href="{{ url('/admin') }}"><button class="btn-grad">Back To Home</button></a>-->
				<a href="{{ url('/admin/bookings') }}"><button class="btn-grad">Active Bookings</button></a>
                <a href="{{ route('completedbookings') }}"><button class="btn-grad">Older Bookings</button></a>
				<a href="{{ route('onaccountnewbookings') }}"><button class="btn-grad">On Account</button></a>				
            </div>


            {{-- {{ $bookings }} --}}
            <table id="example5" class="booktable" border="1">
                <thead>
                    <tr style="background-color:#DD0000; color: #FFFFFF; font-weight:bold">
						@if (Auth::guard('admin')->check()) 
								@if (Auth::guard('admin')->user()->role === "Admin")
									<th></th>
								@endif
						@endif
                        <th>Day Date & Time</th>
                        <th style="white-space: nowrap;">From House No. & Destination House No.</th>
                        <th>Mobile</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Pax</th>
                        <th>Luggage</th>             
                        <th>Vehicle Type</th>
                        <th>Driver</th>
						<th>Flight No</th>
						<th>Company</th>
                        <th>Email</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Return Date & Time</th> 
						@if (Auth::guard('admin')->check()) 
							@if (Auth::guard('admin')->user()->role === "Admin")
								<th>Delete</th> 
								<th style="display:none">Driver Link</th>
								<th style="display:none">User Link</th>
							@endif
						@endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        @php
                            $pickupDate = \Carbon\Carbon::parse($booking->pickup_date);
                            $return = \Carbon\Carbon::parse($booking->date_return_flight);                                
                        @endphp

                        <tr>
							@if (Auth::guard('admin')->check()) 
								@if (Auth::guard('admin')->user()->role === "Admin")					  
									<td>
										<div class="dropdown">
											<button class="dropdown-button">&#8226;&#8226;&#8226;</button>
											<div class="dropdown-content" hidden>
												<!-- Dropdown-opties als links -->
												@if($booking->status != 'Completed')
													 @if (($booking->status == 'pending' && $booking->assign_id == '') || $booking->status == 'Rejected')												
														<button type="button" class="no-border-btn btn-block bg-gradient-primary assign-btn myBtn"
												data-toggle="modal" data-id="{{ $booking->id }}"
												data-target="#assignDriverModal">Assign</button>
													@else
														<button type="button" 
															class="no-border-btn btn-block bg-gradient-primary assign-btn myBtn" data-toggle="modal"
															data-id="{{ $booking->id }}" data-target="#assignDriverModal">Assigned</button>
													@endif

													 <button type="button" class="no-border-btn btn-block bg-gradient-primary complete-ride-btn" data-id="{{ $booking->id }}">Complete</button>


													<!-- <a href="{{ url('/admin/bookings/' . $booking->id . '/retFlight') }}">
														Return Booking
													</a> -->	
													<a href="" data-booking-id="{{ $booking->id }}" class ="return-booking">Return Booking</a>
													<a href="" data-booking-id="{{ $booking->id }}" class ="copy-booking">Copy</a>
													<!--<a href="{{ url('/admin/bookings/' . $booking->id . '/copy2') }}">
														Copy</a>-->
													<a href="" data-booking-id="{{ $booking->id }}" class ="edit-booking">Edit</a>
													<!--<a href="{{ url('/admin/bookings/' . $booking->id . '/edit') }}"
														>Edit</a>-->
													<div class="user-receipt-dropdown">
														<button type="button" class="no-border-btn btn-block bg-gradient-primary" onclick="toggleReceiptSubmenu({{ $booking->id }})">
															User Receipt
														</button>
														<div id="receipt-submenu-{{ $booking->id }}" class="receipt-submenu" style="display: none; margin-left: 10px;">
															@if ($booking->assign_id != '')
																<a href="{{ url('/user-receipt', $booking->assign_id) }}">WhatsApp</a>
																<a href="{{ url('/user-receipt-email', $booking->assign_id) }}">E-mail</a>
															@else
																<a href="{{ url('/user-receipt-no-assign', $booking->id) }}">WhatsApp</a>
																<a href="{{ url('/user-receipt-email-no-assign', $booking->id) }}">E-mail</a>
															@endif
														</div>
													</div>
												<!--	<form method="POST" action="{{ url('/admin/bookings/' . $booking->id) }}">
														@csrf
														@method('DELETE')
														<a href="" type="submit" 
															onclick="return confirm('Are you sure you want to delete this record?')">
															Delete
														</a>
													</form>  -->												
												@endif
                                                @if ($booking->status != 'pending')
                                                    @php
                                                        $phone = '31' . ltrim($booking->driver_phone, '0');																				
                                                    /*	if (str_contains($booking->pickup_address, "Schiphol")
                                                            $pickup = "\n*Vluchtnummer:* ";
                                                        else
                                                            $pickup = "\n*Huisnummer:* ";
                                                        endif
                                                    $pickup = "\n*Huisnummer:* "; */
                                                        $message = "Hallo " . $booking->driver_name . "," . "\n\nDeze rit is aan jou toegewezen: " . "\n\n*Datum:* " . $pickupDate->format('D') . " " . $pickupDate->format('d-m-Y') . "\n*Tijd:* " . $booking->pickup_time . "\n*Van:* " . ($booking->pickup_address ?? '') . "\n*Huisnummer:* " . ($booking->house_no_from ?? '') . "\n*Naar:* " . " " . ($booking->destination ?? '') . "\n*Huisnummer* " . ($booking->house_no_to ?? '') . "\n*Naam:* " . $booking->name . "\n*Telefoon:* " . $booking->phone ."\n*Bedrijf:* " . $booking->company . "\n*Prijs:* " . $booking->price . "\n*Code:* " . $booking->price1 . "\n*Mode:* " . $booking->mode . "\n*Pax:* " . $booking->press . "\n*Bagage:* " . $booking->luggage . "\n*Voertuig:* " . ($booking->vehicle ?? '') . "\n*Opmerkingen:* " . $booking->remark;
                                                        //$whatsapp_url = "https://wa.me/{$phone}?text={$message}";
                                                        //$whatsapp_url = "https://wa.me/{$phone}?text=" . rawurlencode($message);
                                                    
                                                        $whatsapp_url = "https://api.whatsapp.com/send?phone={$phone}&text=" . urlencode($message); 
                                                        // Forceer * als sterretje (WhatsApp Web heeft soms issues met %2A)
                                                        //$message = str_replace('*', '%2A', $message);
                                                    @endphp
                                                    
                                                    <!--<a href="{{ $whatsapp_url }}" target="_blank">WhatsApp Chauffeur</a>-->
                                                    <a href="{{ url('/admin/whatsapp/' . $booking->id . '/edit') }}" 
                                                    class="btn btn-default btn-icon button"
                                                    target="_blank"
                                                    rel="noopener-noferrer">
                                                    Whatsapp chauffeur
                                                    </a> 
                                                @endif

											</div>
										</div>								
									</td>
								@endif
							@endif
							<!--Date & time-->
                            <td
                                style="width: 10% !important; border: 1px solid #ccc; white-space: nowrap;">
                                <b> {{ $pickupDate->format('D') }}&nbsp; {{ $pickupDate->format('d-m-Y') }}
                                </b>&nbsp;&nbsp;<br>
                                <hr>{{ $booking->pickup_time }}
                            </td>
							<!--from to-->
                            <td class="nowrap" 
								style="width: 12% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                <b>{{ $booking->pickup_address ?? '' }}</b> &nbsp; <b>{{ $booking->house_no_from ?? '' }}</b>
                                <br>
                                <hr> {{ $booking->destination ?? '' }} &nbsp; <b>{{ $booking->house_no_to ?? '' }}</b>
                            </td>
							<!--mobile-->
                            <td
                                style="width: 8% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->phone }}
							</td>
							<!--name-->
                            <td
                                style="width: 8% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->name }}
							</td>
							<!--price-->
                            @if ($booking -> mode == "On Account")									
									<td
										style="width: 6% !important; 
											   padding: 10px; 
											   border: 1px solid #ccc;
										color : red;">
										<b>{{ $booking->price }}</b>
										<hr>{{ $booking->price1 }}
										<hr>{{ $booking->mode }}
									</td>
							@else
									<td
										style="width: 6% !important; 
											   padding: 10px; 
											   border: 1px solid #ccc;">
										<b>{{ $booking->price }}</b>
										<hr>{{ $booking->price1 }}
										<hr>{{ $booking->mode }}
									</td>
							@endif	
							<!--no of passengers-->
                            <td
                                style="width: 2% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->press }}
							</td>
							<!--luggage-->
                            <td
                                style="width: 3% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->luggage }}
							</td>
							<!--vehicle-->		
                            <td
                                style="width: 5% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->vehicle ?? '' }}
                            </td>							
							<!--driver-->
                            <td
                                style="width: 8% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                <font color="#008000">{{ $booking->driver_name ?? '' }}</font> &nbsp;<br>
                            </td>
							<!--flight no-->
                            <td>
								@if (strpos(strtolower($booking->pickup_address), 'schiphol') !== false)
									{{ $booking->house_no_from }}
								@else
									{{ $booking->flight_no_on_return }}
								@endif
							<!--	@if (strpos(strtolower($booking->destination), 'schiphol') !== false)
									{{ $booking->house_no_from }}
								@else
									{{ $booking->flight_no_on_return }}
								@endif -->
							</td>
							<!--company-->
							<td
                                style="width: 8% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->company }}
							</td>
							<!--email-->
                            <td
                                style="width: 6% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
								{{ $booking->email }}
							</td>
							<!--remarks-->
                            <td
                                style="width: 10% !important; white-space:normal;
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                <?php echo str_replace("\n", "<br>", $booking->remark); ?>
							</td>							
							<!--status-->
                            <td
                                style="width: 5% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->status }}
							</td>
							<!--return date & time-->
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
							@if (Auth::guard('admin')->check()) 
								@if (Auth::guard('admin')->user()->role === "Admin")
									<!--delete-->
									<td>
										 <form method="POST" action="{{ url('/admin/bookings/' . $booking->id) }}">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn-grads btn-default btn-icon button ml-1"                                        										
												onclick="return confirmDelete('{{ $booking->name }}', '{{ $booking->date }}', '{{ $booking->time }}',  '{{ $booking->pickup_address }}', '{{ $booking->house_no_from }}', '{{ $booking->destination }}', '{{ $booking->house_no_to }}' )">
												<i class="fas fa-trash"></i>
											</button>
										</form>
									</td>
									<!--driver link-->
									<td style="display:none">
										@if ($booking->assign_id != '')
											<a href="{{ url('/driver-confirmation', $booking->assign_id) }}">Confirmation
												Link 1</a>
										@endif
									</td>
									<!--user link-->
									<td style="display:none">
										@if ($booking->assign_id != '' && $booking->status == 'Accepted')
											<a href="{{ url('/user-confirmation', $booking->assign_id) }}">Confirmation
												Link 2</a>
										@endif
									</td>
								@endif
							@endif
                           {{-- <td class="d-flex">
                          
                            @if($booking->status != 'Completed')
                                @if (($booking->status == 'pending' && $booking->assign_id == '') || $booking->status == 'Rejected')
                                    <button type="button" class="btn-grads btn-block bg-gradient-primary assign-btn myBtn"
                                        data-toggle="modal" data-id="{{ $booking->id }}"
                                        data-target="#assignDriverModal">Assign</button>
                                @else
                                    <button type="button" 
                                        class="btn-grads btn-block bg-gradient-primary assign-btn myBtn" data-toggle="modal"
                                        data-id="{{ $booking->id }}" data-target="#assignDriverModal">Assigned</button>
                                @endif
                                
                                <button type="button" class="btn-grads btn-block bg-gradient-primary complete-ride-btn" data-id="{{ $booking->id }}">Complete</button>
								
								@if (strpos($booking->destination, 'Schiphol') !== false)
									<button class="btn-grads btn-default btn-icon button ml-1">
										<a class="btn-white" href="{{ url('/admin/bookings/' . $booking->id . '/retFlight') }}">
											<i class="fas fa-edit">Return Flight</i>
										</a>	
									</button>
								@endif
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

                            @endif
                            </td> --}}		
                        </tr>
                    @endforeach
                </tbody>
            </table>      
        </div>
	
		

       
    </div>

	<div id="addbooking-section"  style="display: none;" >
		@include("layouts.addbookings")
		<br />		
	</div>

	<div id="returnbooking-section"  style="display: none;" >
		@include("layouts.addreturnbookings")
		<br />
	</div>

	<div id="editbooking-section"  style="display: none;" >
		@include("layouts.editbookings")
		<br />
	</div>

	<div id="copybooking-section"  style="display: none;" >
		@include("layouts.copybookings")
		<br />
	</div>


    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	
	<script async
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete">
	</script>
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
		
		function confirmDelete(name, date, time, pickup, house_from, destination, house_to) {
            var message = 'Are you sure you want to delete this record?\n\n' +
                          'Name: ' + name + '\n' +
                          'Date: ' + date + '\n' +
						  'Time: ' + time + '\n' +
				          'Pickup: ' + pickup + ' ' + house_from + '\n' +
				          'Destination: ' + destination + ' ' + house_to;
            return confirm(message);     
		}
		
		function toggleReceiptSubmenu(id) {
			const submenu = document.getElementById('receipt-submenu-' + id);
			submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
		}
    </script>
    



    

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
			$('#chauffeur').change(function() {
				$('#filterForm').submit();
			});

			$("#add-booking").click(function(event) {
				event.preventDefault();
				$("#example5").hide();
				$("#returnbooking-section").hide();
				$("#editbooking-section").hide();
				$("#addbooking-section").show();

			});
		
			$(".return-booking").click(function(event) {
				event.preventDefault();
				
                // Scrollpositie opslaan in localStorage
                localStorage.setItem('scrollBookings', window.scrollY);
                localStorage.setItem('activeCompleted', 'Active');

				var bookingId = $(this).data('booking-id');
        		var url = "/admin/bookings/" + bookingId + "/retFlight?tab=active";
				$("#example5").hide();
				$("#editbooking-section").hide();
				$("#addbooking-section").hide();
				$("#returnbooking-section").show();
				// Voer AJAX-verzoek uit om de pagina met de boeking weer te geven
				$.get(url, function(data) {
					$("#returnbooking-section").html(data);
				});

			});
	
			$(".edit-booking").click(function(event) {
				event.preventDefault();

                // Scrollpositie opslaan in localStorage
                localStorage.setItem('scrollBookings', window.scrollY);
                localStorage.setItem('activeCompleted', 'Active');
				
				var bookingId = $(this).data('booking-id');
        		                
                var url = "/admin/bookings/" + bookingId + "/edit?tab=active";
				$("#example5").hide();
				$("#addbooking-section").hide();
				$("#returnbooking-section").hide();				
				$("#editbooking-section").show();
				// Voer AJAX-verzoek uit om de pagina met de boeking weer te geven
				$.get(url, function(data) {
					$("#editbooking-section").html(data);
				});

			});
	
			$(".copy-booking").click(function(event) {
				event.preventDefault();
				
                // Scrollpositie opslaan in localStorage
                localStorage.setItem('scrollBookings', window.scrollY);
                localStorage.setItem('activeCompleted', 'Active');

				var bookingId = $(this).data('booking-id');
        		var url = "/admin/bookings/" + bookingId + "/copy2?tab=active";
				$("#example5").hide();
				$("#addbooking-section").hide();
				$("#returnbooking-section").hide();	
				$("#editbooking-section").hide();
				$("#copybooking-section").show();
				// Voer AJAX-verzoek uit om de pagina met de boeking weer te geven
				$.get(url, function(data) {
					$("#copybooking-section").html(data);
				});

			});
	
	
	
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
        choiceSelect.addEventListener('change', function(){
			if (!input3.value.trim()) {
				input3.value = 'Flight ';
			}
			toggleInputValidation();
		});
		/*document.getElementById('choice-add').addEventListener('change', toggleInputValidation);
		document.getElementById('choice-copy').addEventListener('change', toggleInputValidation);
		document.getElementById('choice-edit').addEventListener('change', toggleInputValidation);
		document.getElementById('choice-return').addEventListener('change', toggleInputValidation);*/


        // Trigger the function when the page is fully loaded
        document.addEventListener('DOMContentLoaded', function(){
			if (!input3.value.trim()) {
				input3.value = 'Flight ';
			}
			toggleInputValidation();
		});

	
       

        function initAutocomplete() {
			//alert("oke bookings");
				var options = {
					fields: ["formatted_address", "geometry", "name", "address_components", "icon"],
				};
				var inputs = document.getElementsByClassName('pg-autocomplete');
			/*	inputs.forEach(function(input) {
					if (!input.autocompleteInstance) { // alleen als er nog geen instance is
						input.autocompleteInstance = new google.maps.places.Autocomplete(input, options);

						input.autocompleteInstance.addListener("place_changed", function() {
							var place = this.getPlace();
							alert("Gekozen adres: " + place.formatted_address);
						});
					}
				}); */
				for (var i = 0; i < inputs.length; i++) {
					new google.maps.places.Autocomplete(inputs[i], options);
				}
				document.querySelector(".pg-track-location").addEventListener("click", function() {
					console.log("Location tracking clicked"); // Debug
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					}
				});
			
        }
		
		function showPosition(position) {
			try {
				console.log("showPosition called with position:", position); // Debug
				var lat = position.coords.latitude;
				var lng = position.coords.longitude;
				var geocoder = new google.maps.Geocoder();
				var latLng = new google.maps.LatLng(lat, lng);
				geocoder.geocode({'latLng': latLng}, function(results, status) {
					console.log("Geocode results:", results, "Status:", status); // Debug
					if (status === google.maps.GeocoderStatus.OK) {
						if (results[0]) {
							console.log("Result found:", results[0]); // Debug
							var input = document.getElementsByClassName('pg-autocomplete')[0];
							input.value = results[0].formatted_address;

							// Check if the address contains "Schiphol"
							if (results[0].formatted_address.includes('Schiphol')) {
								alert("Schiphol");
								document.getElementById('house-to').style.display = 'none';
							} else {
								alert("geen schiphol");
								document.getElementById('house-to').style.display = 'block';
							}

							// Manueel de change event triggeren
							var event = new Event('change');
							input.dispatchEvent(event);
						} else {
							alert("geen results[0]");
						}
					} else {
						console.log("Geocoder status not OK:", status); // Debug
					}
				});
			} catch (error) {
				console.error("Error in showPosition:", error); // Debug
			}
		}



    /*    function showPosition(position) {
			//console.log("showPosition called with position:", position); // Debug
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            var geocoder = new google.maps.Geocoder();
            var latLng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({
                'latLng': latLng
            }, function(results, status) {
				console.log("Geocode results:", results, "Status:", status); // Debug
                if (status === google.maps.GeocoderStatus.OK) {
					
                    if (results[0]) {
						console.log("Result found:", results[0]); // Debug
                        //document.getElementsByClassName('pg-autocomplete')[0].value = results[0].formatted_address;
						var input = document.getElementsByClassName('pg-autocomplete')[0];
                input.value = results[0].formatted_address;

						
						  // Check if the address contains "Schiphol"
						  if (results[0].formatted_address.includes('Schiphol')) {
							  alert("Schiphol");
							document.getElementById('house-to').style.display = 'none';
						  } else {
							  alert("geen schiphol");
							document.getElementById('house-to').style.display = 'block';
						  }
						
						// Manueel de change event triggeren
						// Manueel de change event triggeren
                var event = new Event('change');
                input.dispatchEvent(event);
                    }
					else alert("geen results[0]");
                }
            });
        } */
		
		// Initialiseer de autocomplete als het script geladen is
document.addEventListener('DOMContentLoaded', initAutocomplete);
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
                            window.location.reload();
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
        window.addEventListener('load', function() {
            const pos = localStorage.getItem('scrollBookings');
            const active = localStorage.getItem('activeCompleted');
            if(active === 'Active' && pos) {
                window.scrollTo(0, pos);
                localStorage.removeItem('scrollBookings');
            }
        });
    </script>

@section('footer-scripts')

@endsection

 