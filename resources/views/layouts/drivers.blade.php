@extends('layouts.app')

@section('main-section')

<!-- Content Wrapper. Contains page content -->
<form id="orderForm" action="{{ route('drivers.update-order') }}" method="POST">
     @csrf
    <!-- Verborgen input waarin de gesorteerde chauffeur-ID's als een komma-gescheiden string worden opgeslagen -->
    <input type="hidden" name="order" id="orderInput" value="">

	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <div class="container-fluid">
			<div class="row mb-2">
			  <div class="col-sm-6">
				<h1>Drivers</h1>
			  </div>
			  <div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
				  <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
				  <li class="breadcrumb-item active">Drivers</li>
				</ol>
			  </div>
			</div>
		  </div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content">
		  <div class="container-fluid">
			<div class="row">
			  <div class="col-12">
				<div class="card">

				  <!-- /.card-header -->
				  <div class="card-body">
					<table id="example2" class="table table-bordered table-hover table-striped">
					  <thead>
					  <tr>
					<!--	  <th></th>-->
						<th>Name</th>
						<th>Email</th>
						<th>Phone/Mobile</th>
						<th>Car</th>


					  </tr>
					  </thead>
					  <tbody id="sortable">
						  @foreach ($drivers as $driver)
								<tr  data-id="{{ $driver->id }}">
									<!--<td class="drag-handle" style="cursor: grab;">☰</td>-->
									<td>{{ $driver->name }}</td>
									<td>{{ $driver->email }}</td>
									<td>{{ $driver->phone }}</td>
									<td>{{ $driver->car_number }}</td>
									<td class="d-flex">
										<a href="{{ url('/admin/drivers/' . $driver->id . '/edit') }}" class="btn btn-default btn-icon button"><i class="fas fa-edit"></i></a>
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
			</div>
			<!-- /.row -->
		  </div>
		  <!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	  </div>
</form>
  <!-- /.content-wrapper -->
  @endsection

