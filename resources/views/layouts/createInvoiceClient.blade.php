@extends('layouts.app')

@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Create Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              
              	<!-- form start -->
				<form method="POST" action="{{ route('admin.invoiceClient') }}" >
					@csrf
					<table class="table-responsive">
						<tr>
							<th>Driver</th>
						</tr>
						<tr>
							<td>
								<select class="" id="client" name="client">
									<option value="" class="" >Choose a client</option>
									@foreach ($clients as $client)
										<option value="{{ $client }}">{{ $client }}</option>
									@endforeach
								</select>				
							</td>
						</tr>
						
						<tr>
							<th>Year</th>
							<th></th>
							<th>Month</th>
						</tr>
						<tr>
							<td>
								<input type = "number" name="year">
							</td>
							<td></td>
							<td>
								<select name="month">
									<option>Choose a month</option>
									<option value="1">Januari</option>
									<option value="2">Februari</option>
									<option value="3">Maart</option>
									<option value="4">April</option>
									<option value="5">Mei</option>
									<option value="6">Juni</option>
									<option value="7">Juli</option>
									<option value="8">Augustus</option>
									<option value="9">September</option>
									<option value="10">Oktober</option>
									<option value="11">November</option>
									<option value="12">December</option>
								</select>
							</td>
						</tr>
					</table>
					<!-- /.card-body -->
					<div class="card-footer">
						<button class="btn btn-primary"><a href="{{ url('/admin') }}" style="color:white;">Cancel</a></button>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>

            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection