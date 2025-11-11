

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
	<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" >

    <title>Afbeelding centreren</title>
    <style>
        .center-img {
            display: block; /* Zorg ervoor dat de afbeelding een block-element wordt */
            margin-left: auto; /* Automatische marge aan de linkerzijde */
            margin-right: auto; /* Automatische marge aan de rechterzijde */
            width: 300px; /* Of een andere breedte naar wens */
        }
    </style>
</head>
<body>
    <img width="300" height="50" class="center-img" src="https://www.spl.taxi/wp-content/uploads/2022/08/Spl-Taxi-logo-www-bold-300.png" alt="SPL Schiphol Taxi">
	<div class="mb-5"></div>
	<div class="row">
		<div>
		<form action="{{ route('invoice.update') }}" method="POST">
			@csrf

			<input type="hidden" value="{{ $invoice->id }}" name="id">
			<input type="hidden" value="{{ $invoice->driver_id }}" name="driver_id">
			<input type="hidden" value="{{ $invoice->year }}" name="year">
			<input type="hidden" value="{{ $invoice->month }}" name="month">

			<table class="table-responsive table-borderless">
				<thead>
					<tr>
						<td colspan="2"><h3>Edit ride</h3></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="font-weight:bold;">Driver</td>
						<td>{{ $invoice->driver_name }}</td>
					</tr>
					<tr>
						<td style="font-weight:bold;">From</td>
						<td>{{ $invoice->from }}</td>
					</tr>			
					<tr>
						<td style="font-weight:bold;">Destination</td>
						<td>{{ $invoice->to }}</td>
					</tr>
					<tr>
						<td style="font-weight:bold;">Date</td>
						<td>{{ \Carbon\Carbon::parse($invoice->date)->format('d-m-Y') }} {{ $invoice->time }}</td>
					</tr>
					<tr>
						<td style="font-weight:bold;">Price</td>
						<td><input type="number" step="0.01" class="col-sm-3" value="{{ $invoice->price }}" name="price"></td>
					</tr>
					<tr>
						<td style="font-weight:bold;">Provision</td>
						<td><input type="number" step="0.01" class="col-sm-3" value="{{ $invoice->commissie }}" name="commissie"></td>
					</tr>
				</tbody>
				<tr style="height: 20px;"></tr> <!-- Lege rij voor extra ruimte -->
				<tfoot>
					<tr>
						<td colspan="2" style="text-align:left"><button type="submit" class="btn btn-primary btn-sm"> update</button></td>
						<td>
							<form action="{{ route('admin.showinvoice', ['driver_id' =>$invoice->driver_id, 'year' => $invoice->year, 'month' => $invoice->month]) }}" method="POST">
								@csrf
								
											<button type="submit" class="btn btn-primary btn-sm">Return to invoice</button>
							</form>
						</td>
					</tr>
				</tfoot>
			</table>

		</form>
			
		</div>
		
	</div>
</body>
</html>
