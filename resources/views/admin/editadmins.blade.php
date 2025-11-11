@extends('layouts.app')

@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Admin</li>
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
<form id="update-admin-form" method="POST" action="{{ route('admins.update') }}">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <input type="hidden" id="id" name="id" value="{{ $admin->id }}">
            <label for="name">Name</label>			
            <input type="text" name="name" class="form-control" id="name" value="{{$admin->name}}" placeholder="Enter name">
        </div>
		<div class="form-group">
            <input type="hidden" id="id" name="id" value="{{ $admin->id }}">
            <label for="email">Email</label>			
            <input type="text" name="email" class="form-control" id="email" value="{{$admin->email}}" placeholder="Enter email">
        </div>
		<div class="form-group">
            <input type="hidden" id="id" name="id" value="{{ $admin->id }}">
            <label for="role">Role</label>			
            <input type="text" name="role" class="form-control" id="role" value="{{$admin->role}}" placeholder="Enter role">
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
		<button class="btn btn-primary"><a href="{{ url('/admin/admins') }}" style="color:white;">Cancel</a></button>
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