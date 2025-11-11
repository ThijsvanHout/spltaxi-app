

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
			padding-top:10px;
            width: 500px; /* Of een andere breedte naar wens */
        }
		
		
    }
    </style>
</head>
<body>
	<div class="mb-3 row">
		<button class="col-sm-2 btn btn-primary btn-sm"><a href="{{ url('/admin') }}" style="color:white;">Return to Dashboard</a></button>
		<div class="col-sm-8"></div>
		<button class="col-sm-1  btn btn-primary btn-sm" id="downloadPdf">Download PDF</button>
	</div>
	@php
		function getBase64Image($url) {
			$imageData = file_get_contents($url);
			return 'data:image/png;base64,' . base64_encode($imageData);
		}
		$logoBase64 = getBase64Image('https://www.spl.taxi/wp-content/uploads/2022/08/Spl-Taxi-logo-www-bold-300.png');
	@endphp
	
	@if($invoice[0]->from == "nvt")
		<div class="center-img" style="border:solid 8px red; width:30%; padding:10px;">
			<p>LET OP!<p>
			<p>De client {{ $invoice[0]->client }} heeft geen ritten gehad in {{ $invoice[0]->monthName }} {{ $invoice[0]->year }}</p>
		</div>
	@else
		<div id="contentToExport">
			<img width="300" height="50" class="center-img mt-3" src="https://www.spl.taxi/wp-content/uploads/2022/08/Spl-Taxi-logo-www-bold-300.png" alt="SPL Schiphol Taxi">
			<div class="mt-3">
				<div class="row d-flex">
					<div class="col-sm-3" style="font-size: larger; font-weight:bold;">Klant</div>
					<div class="col-sm-4" style="font-size: larger; font-weight:bold;">:  {{ $invoice[0]->client }}</div>
				</div>
				<div class="row d-flex mt-1">
					<div class="col-sm-3" style="font-size: larger; font-weight:bold;">Periode</div>
					<div class="col-sm-4" style="font-size: larger; font-weight:bold;">:  {{ $invoice[0]['monthName'] }} {{ $invoice[0]['year'] }} </div>
				</div>
				<div class="row d-flex mt-3">
					<div class="col-sm-3" style="font-size: larger; font-weight:bold;">Totaal gereden</div>
					<div class="col-sm-4" style="font-size: larger; font-weight:bold;">:  € {{ $invoice[0]['totaal'] }}</div>
				</div>
				<div class="row d-flex mt-4">
					<div class="col-sm-3" style="font-size: larger; font-weight:bold;">Totaal provisie netto</div>
					<div class="col-sm-4" style="font-size: larger; font-weight:bold;">:  € {{ $invoice[0]['totaal_commissie'] }}</div>
				</div>
				<div class="row d-flex mt-1">
					<div class="col-sm-3" style="font-size: larger; font-weight:bold;">Totaal provisie BTW 21%</div>
					<div class="col-sm-4" style="font-size: larger; font-weight:bold;">:  € {{ number_format($invoice[0]['totaal_commissie'] * 0.21, 2, ',', '.') }}</div>
				</div>
				<div class="row d-flex mt-1 mb-5">
					<div class="col-sm-3" style="font-size: larger; font-weight:bold;">Totaal provisie</div>
					<div class="col-sm-4" style="font-size: larger; font-weight:bold;">:  € {{ number_format($invoice[0]['totaal_commissie'] * 1.21, 2, ',', '.') }}</div>
				</div>		
			</div>

			<table class="table table-responsive table-borderless border-collapse">
				<thead>
					<tr>
						<th>Datum</th>
						<th>Tijd</th>
						<th>Van</th>
						<th>Naar</th>
						<th>Rit prijs</th>
						<th>Provisie</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($invoice as $row)


						<tr>
							<td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($row['date'])->format('d-m-Y') }}</td>
							<td>{{ $row['time'] }}</td>
							<td>{{ $row['from'] }}</td>
							<td>{{ $row['to'] }}</td>
							<td>€ {{ number_format(floatval(str_replace(',', '.', $row['price'])), 2, ',', '.') }}
</td>
							<td>€ {{ $row['commissie'] }}</td>					
							<td> 
								<button type="button" 
										class="btn btn-sm"
										data-toggle="modal" 
										data-target="#editInvoiceModal"
										data-id ="{{ $row['id'] }}"
										data-year ="{{ $row['year'] }}"
										data-month ="{{ $row['month'] }}"
										data-client="{{ $row['client'] }}"
										data-from="{{ $row['from'] }}"
										data-to="{{ $row['to'] }}"
										data-date="{{ $row['date'] }}"
										data-time="{{ $row['time'] }}"
										data-price="{{ $row['price'] }}"
										data-commission="{{ $row['commissie'] }}">
										<i class="fas fa-edit"></i>
								</button>
							</td>
							<!--oude button 
								<td><a href="{{ route('admin.editinvoice', ['id' => $row->id,  'year' => $row->year, 'month' => $row->month, 'monthName' => $row->monthName, 'driver_id' => $row->driver_id, 'totaal' => $row->totaal, 'totaal_commissie' => $row->totaal_commissie]) }}" class="btn btn-default btn-icon button">
			<i class="fas fa-edit"></i>
								</a></td>-->
						</tr>				
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td style="font-weight:bold;">Totaal</td>
						<td style="font-weight:bold;">€ {{ $invoice[0]['totaal'] }}</td>
						<td style="font-weight:bold;">€ {{ $invoice[0]['totaal_commissie'] }}</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	@endif
	<div id="editInvoiceModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="editInvoiceModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="{{ route('invoice.update') }}" method="POST">
				@csrf
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="editInvoiceModalLabel">Edit invoice</h5>
					</div>

					<div class="modal-body">


							<input type="hidden" id="idField" name="id">
							<input type="hidden" id="yearField" name="year">
							<input type="hidden" id="monthField" name="month">
							<table class="table-responsive table-borderless">

								<tbody>
									<tr>
										<td style="font-weight:bold; padding-right:10px;">Client</td>
										<td class="ml-3" id="clientField"></td>
									</tr>
									<tr>
										<td style="font-weight:bold; padding-right:10px;">From</td>
										<td id="fromField"></td>
									</tr>
									<tr>
										<td style="font-weight:bold; padding-right:10px;">Destination</td>
										<td id="toField"></td>
									</tr>
									<tr>
										<td style="font-weight:bold; padding-right:10px;">Date & Time</td>
										<td id="dateField"></td>
									</tr>
									<tr>
										<td style="font-weight:bold; padding-right:10px;">Price</td>
										<td>
											<input type="number" step="0.01" class="form-control" id="priceField" name="price">
										</td>
									</tr>
									<tr>
										<td style="font-weight:bold; padding-right:10px;">Commission</td>
										<td>
											<input type="number" step="0.01" class="form-control" id="commissionField" name="commissie">
										</td>
									</tr>
								</tbody>
							</table>
					</div>
					<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-sm"> Update</button></td>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>		
					</div>
			</form>
        </div>
    </div>

</body>
</html>

	<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--pdfmake-->
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script>
	$('#editInvoiceModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget); // De knop die de modal triggert
	  // Lees de data-attributen uit:
	  var id = button.data('id');
	  var year = button.data('year');
	  var month = button.data('month');
	  var client = button.data('client');
	  var from = button.data('from');
	  var to = button.data('to');
	  var date = button.data('date');
	  var time = button.data('time');
	  var price = button.data('price');
	  var commission = button.data('commission');
		alert(price);

	  // Combineer eventueel datum en tijd
	  var dateTime = new Date(date).toLocaleDateString() + ' ' + time;
		
	  // Zet komma om naar punt
	  var formattedPrice = price.toString().replace(',', '.');


	  // Vul de modal met de verkregen waarden:
	  var modal = $(this);
	  modal.find('#idField').val(id);
	  modal.find('#yearField').val(year);
	  modal.find('#monthField').val(month);
	  modal.find('#clientField').text(client);
	  modal.find('#fromField').text(from);
	  modal.find('#toField').text(to);
	  modal.find('#dateField').text(dateTime);
	  modal.find('#priceField').val(formattedPrice);
	  modal.find('#commissionField').val(commission);
	});
	
	document.getElementById('downloadPdf').addEventListener('click', function () {
		var logoBase64 = @json($logoBase64);
		var invoiceData = @json($invoice);
        var invoiceDetails = [
            [{ text: 'Bedrijf', bold: true }, { text: invoiceData[0].company }],
            [{ text: 'Periode', bold: true }, { text: invoiceData[0].monthName + " " + invoiceData[0].year }],
            [{ text: 'Totaal gereden', bold: true }, { text: "€ " + parseFloat(invoiceData[0].totaal).toFixed(2).replace('.', ',') }],
            [{ text: 'Totaal provisie netto', bold: true }, { text: "€ " + parseFloat(invoiceData[0].totaal_commissie).toFixed(2).replace('.', ',') }],
            [{ text: 'Totaal provisie BTW 21%', bold: true }, { text: "€ " + (parseFloat(invoiceData[0].totaal_commissie) * 0.21).toFixed(2).replace('.', ',') }],
            [{ text: 'Totaal provisie', bold: true }, { text: "€ " + (parseFloat(invoiceData[0].totaal_commissie) * 1.21).toFixed(2).replace('.', ',') }]
        ];

        // **Tabel met ritten**
        var tableBody = [
            [{ text: 'Datum', bold: true }, { text: 'Tijd', bold: true }, { text: 'Van', bold: true }, { text: 'Naar', bold: true }, { text: 'Rit prijs', bold: true }, { text: 'Provisie', bold: true }]
        ];

        invoiceData.forEach(row => {
            tableBody.push([
                { text: row.date },
                { text: row.time },
                { text: row.from },
                { text: row.to },
                { text: '€ ' + parseFloat(row.price).toFixed(2).replace('.', ',') },
                { text: '€ ' + parseFloat(row.commissie).toFixed(2).replace('.', ',') }
            ]);
        });

        // **Totaalregel toevoegen**
        tableBody.push([
            { text: '', colSpan: 3 }, {}, {},
            { text: 'Totaal', bold: true },
            { text: '€ ' + parseFloat(invoiceData[0].totaal).toFixed(2).replace('.', ','), bold: true },
            { text: '€ ' + parseFloat(invoiceData[0].totaal_commissie).toFixed(2).replace('.', ','), bold: true }
        ]);

        // **pdfMake document aanmaken**
        var docDefinition = {
			//pageOrientation: 'landscape', // Zet de PDF in landscape-modus
            content: [
                { image: logoBase64, width: 300 },
                { text: 'Factuur', style: 'header' },
                { text: ' ', margin: [0, 10] },
                {
                    table: { widths: ['25%', '50%'], body: invoiceDetails }
                },
                { text: ' ', margin: [0, 10] },
                {
                    table: { widths: ['15%', '10%', '20%', '20%', '15%', '15%'], body: tableBody }
                }
            ],
            styles: {
                header: { fontSize: 18, bold: true, alignment: 'center' },
                body: { fontSize: 12 }
            }
        };

        pdfMake.createPdf(docDefinition).download('factuur.pdf');
    });
	
	function getBase64Image(url, callback) {
    var img = new Image();
    img.crossOrigin = 'Anonymous'; 
    img.onload = function () {
        var canvas = document.createElement("canvas");
        canvas.width = img.width;
        canvas.height = img.height;
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL("image/png");
        callback(dataURL);
    };
    img.src = url;
}

</script>
