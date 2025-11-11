

<head>
	<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" >
</head>
<style>
	/* CSS om het inputveld de volledige breedte van de cel te geven */
	.form-control {
		width: 100%;
		box-sizing: border-box; /* Voorkomt extra ruimte door padding en border */
	}



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
		width:100%;
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
}


	
</style>
<div class="container table-responsive" >
	<form id="add-booking-form" method="POST" action="{{ route('bookings.adminstore') }}">
		@csrf
		<table class="table table-responsive-lg table-bordered" border="1">
			<thead>
				<th colspan="4" class="text-center align-middle" ><button type="submit" class="btn btn-red">Add booking</button></th>
			</thead>
			<tr>
				<td><b>Date, Time </b></td>
				<td colspan="1"> 
					<input type="date" id="datepicker" required name="pickup_date"
										class=" datepicker">
				</td>
				<td>
					<input type="time" required name="pickup_time" placeholder="HH:mm"
										class="">
				</td>
				{{--<td colspan="1"> </td> --}}

			</tr>

			<tr>
				<td><b>From</b></td>
				<td colspan="2"><input type="text" required class="form-control pg-autocomplete"
									   value="" name="pickup_address" placeholder="Enter From"></td>
			
			</tr>
			<tr>
				<td></td>
				<td colspan="1"><input type="text" required class="form-control" value=""
									   name="house_no_from" placeholder="House/Flight No"></td>
			

			</tr>
			<tr>
				<td><b>To</b></td>
				<td colspan="2"><input type="text" class="form-control pg-autocomplete" id="to"
									   name="to" required value="Schiphol" placeholder="Enter Destination"></td>
			</tr>
			<tr id="schiphol">
				<td></td>
				<td colspan="1"><input type="text" required class="form-control" id="house_to"
									   name="house_no_to" value="-" placeholder="House No."></td>

			</tr>
			<tr>
				<td  rowspan="1"><b>Price (Customer,Taxi)</b></td>
				<td>				
					<input type="text" name="price" id="price" class="form-control" value="€">
				</td>
				<td><input type="text" name="price1" id="price1" value="Code €" class="form-control">
				</td>
			</tr>
			<tr>
				<td></td>
				<td style="width:12%">
					<select name="mode" id="mode" class="">
						<option value="Cash">Cash</option>
						<option value="On Account">On Account</option>
						<option value="Pin Payment">Pin Payment</option>
						<option value="Credit Card">Credit Card</option>					
						<option value="Remittance">Remittance</option>
						<option value="No Payment">No Payment</option>
					</select>
				</td>
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
				<td><b>Mobile, E-mail</b></td>
				<td colspan="1"><input type="text" class="form-control" id="mobile" name="mobile"
									   placeholder="Enter Mobile Number"></td>
				<td colspan="1"><input type="email" class="" name="email" id="email"
									   placeholder="Enter E-mail"></td>
			</tr>
			<tr>
				<td><b>Name</b></td>
				<td colspan="2"><input type="text" name="uname" id="uname" class="form-control"
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
				<td><b>Person(s), Luggage</b></td>
				<td colspan="1"><input type="text" class="form-control" name="press" id="press" value="Pax"
									   placeholder="Enter No of Passenger"></td>
				<td colspan="1"><input type="text" name="luggage" id="luggage" class="" value="Luggage"
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
				<td rowspan="1"><b>Date/Time/Flight No</b></td>
				<td colspan="2">
					<input class="" type="date" name="flight_date"
									   id="flight_date" placeholder="" >
					<input type="time" name="flight_time" id="flight_time"
									   class="">
					<input class="" type="text" name="flight_no" id="flight_no"
													   placeholder="Flight No">
				</td>
				{{--<td colspan="1"></td> --}}
			</tr>
			<tr  class="rethide">
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
<script>
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
	