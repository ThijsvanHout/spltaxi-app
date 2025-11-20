<head>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        display: flex;
    }

    #booking-buttons {
        position: sticky;
        top: 0;
        /* blijft plakken zodra je scrollt naar de tabel */
        background: white;
        z-index: 10;
        padding: 10px 0;
    }

    .form-container {
        flex: 1;
        padding: 20px;
    }

    .flex-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-container {
        flex: 1;
        padding: 20px;
    }

    .modal-xl .modal-dialog {
        max-width: 80%;
        /* Adjust the width as needed */
    }


    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        overflow: auto;
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* max-width: 600px; */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        /* text-align: center; */
    }

    .modal-header {
        padding: 10px;
        background-color: #f2f2f2;
    }

    .header-container {
        display: flex;
        justify-content: flex-end;
        /* Zorgt ervoor dat alles naar rechts gaat */
        align-items: center;
        /* Verticaal gecentreerd */
        padding: 10px;
    }

    .header-container .item {
        margin-left: 20px;
        /* Ruimte tussen de items */
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
        /*width: 30%;*/
        /*text-align: center;*/
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .btn-white {
        color: white !important;
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
        padding: 14px;
        /* padding: 15px 45px; */
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
        padding: 14px;
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

    .select-driver {
        background-color: white !important;
        color: black !important;
    }

    .filter-table {
        padding-left: 25px;
    }

    .centered-td {
        display: flex;
        justify-content: center;
        /* Horizontaal centreren */
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
        width: 100%;
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
        left: 0;
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
        border: none !important;
        background-color: transparent !important;
        margin: 0px 8px;
        /*padding: 15px 15px;*/
        font-size: 17px !important;

        transition: 0.5s;
        background-size: 200% auto;
        color: black !important;
        /*box-shadow: 0 0 20px #eee;*/
        border-radius: 10px;
        display: block;
        text-align: left;


    }

    /* einde dropdown action */
    #book {
        display: flex;
        flex-direction: column;
        /* To stack elements vertically */
        justify-content: left;
        /* To vertically center the element */
        align-items: left;
        /* To horizontally center the element */

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
        <div class="table-container" id="table-booking">
            <h2>Older Bookings</h2>&nbsp;

            <div class="buttons-spl" id="booking-buttons" style="display:flex;">
                @if (Auth::guard('admin')->check())
                    @if (Auth::guard('admin')->user()->role === 'Admin')
                        <a class="mr-4" href="{{ url('/admin') }}"
                            style="font-size:45px;padding : 10px 0px 10px 0px; color:red;">
                            <i class="bi bi-house-door-fill"></i>
                        </a>
                        <!--<a  href="{{ url('/admin/bookings/create') }}"  style="font-size:45px;padding : 10px 0px 10px 0px; margin-right:25px;" >
           <i class="bi bi-plus-lg" ></i>
          </a>-->
                        <a href="" id="add-booking"
                            style="font-size:45px;padding : 10px 0px 10px 0px; margin-right:25px;">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                    @endif
                @endif
                <!--<a href="{{ url('/admin') }}"><button class="btn-grad">Back To Home</button></a>-->
                <a href="{{ url('/admin/bookings') }}"><button class="btn-grad ">Active Bookings</button></a>
                <a href="{{ route('completedbookings') }}"><button class="btn-grad">Older Bookings</button></a>

                <!--<form action="{{ route('bookings-filter') }}" method="POST" id="filterForm">
         @csrf
         <select name="chauffeur" id="chauffeur" class="dropbtn">
          <option value="" class="dropdown-content" >Choose a driver</option>
          @foreach ($drivers as $driver)
    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
    @endforeach
         </select>
        </form>
        

        <a href="{{ route('onaccountcompbookings') }}"><button class="btn-grad">On Account</button></a>-->
                <form action="{{ route('bookings-filterPeriod') }}" method="POST" id="filterPeriodForm">
                    @csrf
                    <table class="booktable" border="1">
                        <thead>
                            <tr>
                                <th colspan="4">Filter</th>
                            </tr>
                            <thead>
                            <tbody>
                                <tr>
                                    <td class="filter-table"><label>Name</label></td>
                                    <td class="filter-table"><label>Address</label></td>
                                    <td class="filter-table"><label>Phone</label></td>
                                </tr>
                                <tr>
                                    <td class="filter-table"><input type="text" name="naam"></td>
                                    <td class="filter-table"><input type="text" name="adres"></td>
                                    <td class="filter-table"><input type="text" name="telnr"></td>
                                    <td>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th colspan="2">Select period</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:center;">From</td>
                                                    <td style="text-align:center;">Till</td>
                                                </tr>
                                                <tr>
                                                    <td><input type="date" name="from"></td>
                                                    <td><input type="date" name="till"></td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <select class="select-driver" name="chauffeur" id="chauffeur">
                                            <option value="" class="">Choose a driver</option>
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td colspan="1">
                                        <select class="select-driver" name="company" id="company">
                                            <option value="" class="">Choose a company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->naam }}">{{ $company->naam }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    {{--	<td>
									<select class="select-driver" name="company" id="company">
										<option value="" class="" >Choose a company</option>
										<option value="Easy Rider">Easy Rider</option>
										<option value="Massive Music">Massive Music</option>
										<option value="TCA">TCA</option>
										<option value="Hans Brouwer Prive">Hans Brouwer Prive</option>					
										<option value="Joep Beving Sonderling b.v. ">Joep Beving Sonderling b.v. </option>
										<option value="Stichting Holland Festival">Stichting Holland Festival</option>
										<option value="Wiser Globe">Wiser Globe</option>
										<option value="Politie">Politie</option>
										<option value="Kevlinx Holding BV ">Kevlinx Holding BV </option>
										<option value="Stichting Flamenco Biënnale ">Stichting Flamenco Biënnale </option>
										<option value="Safar Limo Service">Safar Limo Service</option>
										<option value="Vereniging Hoge Scholen">Vereniging Hoge Scholen</option>
										<option value="The Recess College">The Recess College</option>
									</select>
								</td> --}}
                                    <td class="filter-table">
                                        <label for="checkbox">On account:</label>
                                        <input type="checkbox" name="onaccount" id="checkbox">
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"><button type="submit" class="btn btn-grad">Submit</button></td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>


            {{-- {{ $bookings }} --}}


            <table id="example5" class="" border="1" style="width: 125%;">
                <!--<table id="example5" class="booktable" border="1">-->
                <thead>
                    <tr style="background-color:#DD0000; color: #FFFFFF; font-weight:bold">
                        @if (Auth::guard('admin')->check())
                            @if (Auth::guard('admin')->user()->role === 'Admin')
                                <th></th>
                            @endif
                        @endif
                        <th>Day Date & Time</th>
                        <th width="">From House No. & Destination House No.</th>
                        <th width="">Mobile</th>
                        <th width="">Name</th>
                        <th width="">Price</th>
                        <th>Pax</th>
                        <th>Luggage</th>
                        <th width="">Vehicle Type</th>
                        <th width="">Driver</th>
                        <th>Flight No</th>
                        <th width="">Company</th>
                        <th width="">Email</th>
                        <th width="">Remarks</th>
                        <th>Status</th>
                        <th>Return Date & Time</th>
                        @if (Auth::guard('admin')->check())
                            @if (Auth::guard('admin')->user()->role === 'Admin')
                                <th>Invoice</th>
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
                            $return = \Carbon\Carbon::parse($booking->return_pickup_date);

                        @endphp

                        <tr>
                            @if (Auth::guard('admin')->check())
                                @if (Auth::guard('admin')->user()->role === 'Admin')
                                    <td>
                                        <div class="dropdown">
                                            <button class="dropdown-button">&#8226;&#8226;&#8226;</button>
                                            <div class="dropdown-content" hidden>
                                                @if (($booking->status == 'pending' && $booking->assign_id == '') || $booking->status == 'Rejected')
                                                    <button type="button"
                                                        class="no-border-btn btn-block bg-gradient-primary assign-btn myBtn"
                                                        data-toggle="modal" data-id="{{ $booking->id }}"
                                                        data-target="#assignDriverModal">
                                                        Assign
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        class="no-border-btn btn-block bg-gradient-primary assign-btn myBtn"
                                                        data-toggle="modal" data-id="{{ $booking->id }}"
                                                        data-target="#assignDriverModal">
                                                        Assigned
                                                    </button>
                                                @endif

                                                <button type="button"
                                                    class="no-border-btn btn-block bg-gradient-primary complete-ride-btn"
                                                    data-id="{{ $booking->id }}">
                                                    Complete
                                                </button>


                                                <!-- <a href="{{ url('/admin/bookings/' . $booking->id . '/retFlight') }}">
                 Return Booking
                </a> -->
                                                <a href="" data-booking-id="{{ $booking->id }}"
                                                    class ="return-booking">Return Booking</a>
                                                <a href="" data-booking-id="{{ $booking->id }}"
                                                    class ="copy-booking">Copy</a>
                                                <!--<a href="{{ url('/admin/bookings/' . $booking->id . '/copy2') }}">
                 Copy</a>-->
                                                <a href="" data-booking-id="{{ $booking->id }}"
                                                    class ="edit-booking">Edit</a>
                                                <!--<a href="{{ url('/admin/bookings/' . $booking->id . '/edit') }}"
                >Edit</a>	-->
                                                <div class="user-receipt-dropdown">
                                                    <button type="button"
                                                        class="no-border-btn btn-block bg-gradient-primary"
                                                        onclick="toggleReceiptSubmenu({{ $booking->id }})">
                                                        User Receipt
                                                    </button>
                                                    <div id="receipt-submenu-{{ $booking->id }}" class="receipt-submenu"
                                                        style="display: none; margin-left: 10px;">
                                                        @if ($booking->assign_id != '')
                                                            <a
                                                                href="{{ url('/user-receipt', $booking->assign_id) }}">WhatsApp</a>
                                                            <a
                                                                href="{{ url('/user-receipt-email', $booking->assign_id) }}">E-mail</a>
                                                        @else
                                                            <a
                                                                href="{{ url('/user-receipt-no-assign', $booking->id) }}">WhatsApp</a>
                                                            <a
                                                                href="{{ url('/user-receipt-email-no-assign', $booking->id) }}">E-mail</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- <form method="POST" action="{{ url('/admin/bookings/' . $booking->id) }}">
                 @csrf
                 @method('DELETE')
                 <a href="" type="submit"
                 onclick="return confirm('Are you sure you want to delete this record?')">
                 Delete
                 </a>
                 </form> -->
                                                @php
                                                    $phone = '31' . ltrim($booking->driver_phone, '0');
                                                    $message =
                                                        'Hallo ' .
                                                        $booking->driver_name .
                                                        ',' .
                                                        "\n\nDeze rit is aan jou toegewezen: " .
                                                        "\n\n*Datum:* " .
                                                        $pickupDate->format('D') .
                                                        ' ' .
                                                        $pickupDate->format('d-m-Y') .
                                                        "\n*Tijd:* " .
                                                        $booking->pickup_time .
                                                        "\n*Van:* " .
                                                        ($booking->pickup_address ?? '') .
                                                        "\n*Huisnummer/Vluchtnummer:* " .
                                                        ($booking->house_no_from ?? '') .
                                                        "\n*Naar:* " .
                                                        ' ' .
                                                        ($booking->destination ?? '') .
                                                        "\n*Huisnummer* " .
                                                        ($booking->house_no_to ?? '') .
                                                        "\n*Naam:* " .
                                                        $booking->name .
                                                        "\n*Telefoon:* " .
                                                        $booking->phone .
                                                        "\n*Bedrijf:* " .
                                                        $booking->company .
                                                        "\n*Prijs:* " .
                                                        $booking->price .
                                                        "\n*Code:* " .
                                                        $booking->price1 .
                                                        "\n*Mode:* " .
                                                        $booking->mode .
                                                        "\n*Pax:* " .
                                                        $booking->press .
                                                        "\n*Bagage:* " .
                                                        $booking->luggage .
                                                        "\n*Voertuig:* " .
                                                        ($booking->vehicle ?? '') .
                                                        "\n*Opmerkingen:* " .
                                                        $booking->remark;
                                                    //$whatsapp_url = "https://wa.me/{$phone}?text={$message}";
                                                    $whatsapp_url =
                                                        "https://wa.me/{$phone}?text=" . rawurlencode($message);
                                                    //$whatsapp_url = "https://api.whatsapp.com/send?phone={$phone}&text=" . urlencode($message);
                                                    // Forceer * als sterretje (WhatsApp Web heeft soms issues met %2A)
                                                    //$message = str_replace('*', '%2A', $message);
                                                @endphp

                                                <!--<a href="{{ $whatsapp_url }}" target="_blank">WhatsApp Chauffeur</a>-->
                                                <a href="{{ url('/admin/whatsapp/' . $booking->id . '/edit') }}"
                                                    class="btn btn-default btn-icon button">Whatsapp chauffeur</a>
                                            </div>
                                        </div>
                                    </td>
                                @endif
                            @endif
                            <!--date & time-->
                            <td
                                style="width: 10% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                <b> {{ $pickupDate->format('D') }}&nbsp; {{ $pickupDate->format('d-m-Y') }}
                                </b>&nbsp;&nbsp;<br>
                                <hr>{{ $booking->pickup_time }}
                            </td>
                            <!--from to-->
                            <td
                                style="width: 12% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                <b>{{ $booking->pickup_address ?? '' }}</b> &nbsp;
                                <b>{{ $booking->house_no_from ?? '' }}</b>
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
                            @if ($booking->mode == 'On Account')
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
                            <!--no passengers-->
                            <td
                                style="width: 2% !important; whitespace:normal; 
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
                                <!--	{{ $booking->flight_no_on_return }} -->
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
                            </td><!--remarks-->
                            <td
                                style="width: 5% !important; whitespace:normal;
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                <?php echo str_replace("\n", '<br>', $booking->remark); ?>
                            </td>
                            <!--status-->
                            <td
                                style="width: 5% !important; 
									   padding: 10px; 
									   border: 1px solid #ccc;">
                                {{ $booking->status }}
                            </td>
                            <!--return date&time-->
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
                                @if (Auth::guard('admin')->user()->role === 'Admin')
                                    <!--invoice-->
                                    <td>
                                        {{ $booking->invoice }}
                                    </td>
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
                                    <!--driver confirmation-->
                                    <td style="display:none">
                                        @if ($booking->assign_id != '')
                                            <a href="{{ url('/driver-confirmation', $booking->assign_id) }}">Confirmation
                                                Link 1</a>
                                        @endif
                                    </td>
                                    <!--user confirmation-->
                                    <td style="display:none">
                                        @if ($booking->assign_id != '' && $booking->status == 'Accepted')
                                            <a href="{{ url('/user-confirmation', $booking->assign_id) }}">Confirmation
                                                Link 2</a>
                                        @endif
                                    </td>
                                @endif
                            @endif
                            {{-- <td class="d-flex">
                          
                         
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
								<!--<a href="" class="btn-grads btn-default btn-icon button" data-toggle="modal" data-id="{{ $booking->id }}"
                                        data-target="#copyModal">
							            <i class="fas fa-edit">Copy</i></a>-->
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
                                        onclick="return confirmDelete('{{ $booking->name }}', '{{ $booking->date }}', '{{ $booking->time }}',  '{{ $booking->pickup_address }}', '{{ $booking->house_no_from }}', '{{ $booking->destination }}', '{{ $booking->house_no_to }}' )">

                                        <i class="fas fa-trash">Delete</i>
                                    </button>
                                </form>	    
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <!--</table>-->
        </div>


        <!-- Form Container -->

    </div>

    <div id="addbooking-section" style="display: none;">
        @include('layouts.addbookings')
        <br />
    </div>

    <div id="returnbooking-section" style="display: none;">
        @include('layouts.addreturnbookings')
        <br />
    </div>

    <div id="editbooking-section" style="display: none;">
        @include('layouts.editbookings')
        <br />
    </div>

    <div id="copybooking-section" style="display: none;">
        @include('layouts.copybookings')
        <br />
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
    <div class="modal fade" id="copyModal" tabindex="-1" role="dialog" aria-labelledby="copyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="copyModalLabel">{{ $booking }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <!--<span aria-hidden="true">&times;</span>-->
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    <div class="container table-responsive">
                        <form action="{{ route('bookings.store') }}" method="POST">
                            @csrf
                            <!--<input type="hidden" id="id" name="id" value="{{ $booking->id }}">-->




                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <td><b>Date, Time </b></td>
                                    <td colspan="2"> <input type="date" value="{{ $booking->pickup_date }}"
                                            id="datepicker" required name="pickup_date" class="form-control datepicker">
                                    </td>
                                    <td colspan="3"> <input type="time" value="{{ $booking->pickup_time }}"
                                            required name="pickup_time" placeholder="HH:mm" class="form-control"></td>

                                </tr>
                                <tr>
                                    <td><b>Person(s), Luggage, Vehicle</b></td>
                                    <td><input type="text" value="{{ $booking->press }}" class="form-control"
                                            name="press" id="press" placeholder="Enter No of Passenger"></td>
                                    <td colspan="2"><input type="text" value="{{ $booking->luggage }}"
                                            name="luggage" id="luggage" class="form-control"
                                            placeholder="Enter No of Luggage"></td>
                                    <td colspan="2"><select class="form-control" name="vehicle" id="vehicle">
                                            <option value="Sedan" @if ($booking->vehicle === 'Sedan') selected @endif>Sedan
                                            </option>
                                            <option value="Stationwagen"
                                                @if ($booking->vehicle === 'Stationwagen') selected @endif>Stationwagen</option>
                                            <option value="Bus4" @if ($booking->vehicle === 'Bus4') selected @endif>Bus4
                                            </option>
                                            <option value="Bus5" @if ($booking->vehicle === 'Bus5') selected @endif>Bus5
                                            </option>
                                            <option value="Bus6" @if ($booking->vehicle === 'Bus6') selected @endif>Bus6
                                            </option>
                                            <option value="Bus7" @if ($booking->vehicle === 'Bus7') selected @endif>Bus7
                                            </option>
                                            <option value="Bus8" @if ($booking->vehicle === 'Bus8') selected @endif>Bus8
                                            </option>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><b>From</b></td>
                                    <td colspan="2"><input type="text" value="{{ $booking->pickup_address }}"
                                            class="form-control pg-autocomplete" required name="pickup_address"
                                            placeholder="Enter From"></td>
                                    <td colspan="3"><input type="text" value="{{ $booking->house_no_from }}"
                                            placeholder="From House No" class="form-control" name="house_no_from"
                                            id="from1">
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>To</b></td>
                                    <td colspan="2"><input type="text" value="{{ $booking->destination }}"
                                            class="form-control pg-autocomplete" id="to" name="to"
                                            placeholder="Enter Destination"></td>
                                    <td colspan="3"><input type="text" value="{{ $booking->house_no_to }}"
                                            placeholder="To House No " class="form-control" name="house_no_to"
                                            id="to1">
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Price (Customer,Taxi)</b></td>
                                    <td>


                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa-solid fa-euro-sign"></i></div>
                                            </div>
                                            <input type="text" name="price" value="{{ $booking->price }}"
                                                id="price" class="form-control">

                                        </div>

                                    </td>
                                    <td><input type="text" name="price1" value="{{ $booking->price1 }}"
                                            id="price1" class="form-control"></td>
                                    <td style="width:20%"><select name="mode" id="mode" class="form-control">
                                            <option value="Cash" @if ($booking->mode === 'Cash') selected @endif>Cash
                                            </option>
                                            <option value="On Account" @if ($booking->mode === 'On Account') selected @endif>
                                                On Account
                                            </option>
                                            <option value="Pin Payment" @if ($booking->mode === 'Pin Payment') selected @endif>
                                                Pin Payment
                                            </option>
                                            <option value="Credit Card"
                                                @if ($booking->mode === 'Credit Card') selected @endif>Credit Card
                                            </option>
                                            <option value="Master Card"
                                                @if ($booking->mode === 'Master Card') selected @endif>Master Card
                                            </option>
                                            <option value="American Express"
                                                @if ($booking->mode === 'American Express') selected @endif>
                                                American Express</option>
                                            <option value="Remittance" @if ($booking->mode === 'Remittance') selected @endif>
                                                Remittance
                                            </option>
                                            <option value="No Payment" @if ($booking->mode === 'No Payment') selected @endif>
                                                No Payment
                                            </option>
                                        </select></td>

                                </tr>

                                <tr>
                                    <td><b>Mobile, E-mail, Name</b></td>
                                    <td colspan="1"><input type="text" value="{{ $booking->phone }}"
                                            class="form-control" id="mobile" name="mobile"
                                            placeholder="Enter Mobile Number">
                                    </td>
                                    <td colspan="2"><input type="email" value="{{ $booking->email }}"
                                            class="form-control" name="email" id="email"
                                            placeholder="Enter E-mail"></td>
                                    <td colspan="2"><input type="text" required name="uname"
                                            value="{{ $booking->name }}" id="uname" class="form-control"
                                            placeholder="Enter Your Name"></td>
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
                                    <td colspan="1"><select class="form-control" name="return" id="choice">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select></td>

                                    <td colspan="2" class="rethide"><input class="form-control" type="text"
                                            name="flight_no" id="flight_no" placeholder="Flight No"></td>


                                </tr>
                                <tr class="rethide">
                                    <td rowspan="1"><b>Date/Time</b></td>
                                    <td colspan="2"><input class="form-control" type="date" name="flight_date"
                                            id="flight_date" placeholder=""></td>
                                    <td colspan="1"><input type="time" name="flight_time" id="flight_time"
                                            class="form-control"></td>
                                </tr>
                                <tr class="rethide">
                                    <td><b>Return Remark</b></td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="returnremark" id="returnremark" placeholder="Enter Return Remark">								</textarea>
                                    </td>
                                </tr>

                            </table>
                            <style>
                                .rethide {
                                    display: none;
                                }
                            </style>
                            <div class="row">
                                <div class="col-lg-12" align="right">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </div>







                        </form>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- Additional buttons if needed -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
        $('#chauffeur').change(function() {
            $('#filterForm').submit();
        });

        $("#add-booking").click(function(event) {
            event.preventDefault();
            $("#example5").hide();
            $("#editbooking-section").hide();
            $("#returnbooking-section").hide();
            $("#copybooking-section").hide();
            $("#addbooking-section").show();

        });

        $(".return-booking").click(function(event) {
            event.preventDefault();
            //var url = $(this).attr('href');
            var bookingId = $(this).data('booking-id');
            var url = "/admin/bookings/" + bookingId + "/retFlight";
            $("#example5").hide();
            $("#addbooking-section").hide();
            $("#editbooking-section").hide();
            $("#copybooking-section").hide();
            $("#returnbooking-section").show();
            // Voer AJAX-verzoek uit om de pagina met de boeking weer te geven
            $.get(url, function(data) {
                $("#returnbooking-section").html(data);
            });

        });

        $(".edit-booking").click(function(event) {
            event.preventDefault();

            localStorage.setItem('scrollBookings', window.scrollY);
            localStorage.setItem('activeCompleted', 'Completed');

            var bookingId = $(this).data('booking-id');

            var url = "/admin/bookings/" + bookingId + "/edit?tab=completed";
            $("#example5").hide();
            $("#addbooking-section").hide();
            $("#returnbooking-section").hide();
            $("#copybooking-section").hide();
            $("#editbooking-section").show();
            // Voer AJAX-verzoek uit om de pagina met de boeking weer te geven
            $.get(url, function(data) {
                $("#editbooking-section").html(data);
            });

        });

        $(".copy-booking").click(function(event) {
            event.preventDefault();
            //var url = $(this).attr('href');
            var bookingId = $(this).data('booking-id');
            var url = "/admin/bookings/" + bookingId + "/copy2";
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
    <!-- <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl5y2ApdvxYPlUKgXQnO7SdaYExoxA-AQ&libraries=places&callback=initAutocomplete">
        src =
            "https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete" >
    </script> -->
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete">
    </script>






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

        $("#choice").change(function() {
            if (!input3.value.trim()) {
                input3.value = 'Flight ';
            }
            toggleInputValidation();
        });

        // Add event listener to the select element
        //choiceSelect.addEventListener('change', toggleInputValidation);

        // Trigger the function when the page is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            if (!input3.value.trim()) {
                input3.value = 'Flight ';
            }
            toggleInputValidation();
        });


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
                    var userConfirmation = window.confirm(
                        'Are you sure you want to complete this ride?');

                    if (userConfirmation) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route('admin/bookingStatus') }}', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector(
                            'meta[name="csrf-token"]').getAttribute(
                        'content')); // Assuming you have a meta tag for csrf-token

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
            if (active === 'Completed' && pos) {
                window.scrollTo(0, pos);
                localStorage.removeItem('scrollBookings');
            }
        });
    </script>



<!--@section('footer-scripts')

@endsection
-->
