@extends('layouts.app')

@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admins</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Companies</li>
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
					  <th>Name</th>  
					  <th>Email</th>	
					  <th>Role</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
					<td>{{ $admin->email }}</td>
					<td>{{ $admin->role }}</td>
                    <td class="d-flex">
                        <a href="{{ url('/admin/admins/' . $admin->id . '/edit') }}" class="btn btn-default btn-icon button"><i class="fas fa-edit"></i>Edit name/email/role</a>
						<a href="{{ url('/admin/' . $admin->id . '/password') }}" class="btn btn-default btn-icon button"><i class="fas fa-edit"></i>Change password</a>
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
  <!-- /.content-wrapper -->
  @endsection