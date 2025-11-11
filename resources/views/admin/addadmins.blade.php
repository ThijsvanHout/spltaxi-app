@extends('layouts.app')

@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Add New Admin</li>
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
				<form id="add-admin-form" method="POST" action="{{route('admins.store')}}">
					@csrf
					<div class="card-body">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" class="form-control" value="" id="email" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="newpasssword">New password</label>
							<div class="input-group">								
								<input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Enter new password">
								<div class="input-group-append">
									<span class="input-group-text" id="toggleWachtwoord-new">
										<i class="fas fa-eye" id="eyeIcon-new"></i>
									</span>
								</div>
							</div>
							
							@error('newpassword')
          						<span id="exampleInputEmail1-error" style="display:block" class="error invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="passwordconfirm">Confirm password</label>
							<div class="input-group">								
								<input type="password" name="passwordconfirm" class="form-control" id="passwordconfirm" placeholder="Confirm new password">
								<div class="input-group-append">
									<span class="input-group-text" id="toggleWachtwoord-confirm">
										<i class="fas fa-eye" id="eyeIcon-confirm"></i>
									</span>
								</div>
							</div>
							
							@error('passwordconfirm')
          						<span id="exampleInputEmail1-error" style="display:block" class="error invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="role">Role</label>
							<input type="text" name="role" class="form-control" id="role" placeholder="Enter role (Admin or Guest)">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#toggleWachtwoord-old').click(function() {
            var wachtwoordVeld = $('#password');
            var eyeIcon = $('#eyeIcon');

            // Toggle het invoertype van het wachtwoordveld
            if (wachtwoordVeld.attr('type') === 'password') {
                wachtwoordVeld.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                wachtwoordVeld.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
		
		$('#toggleWachtwoord-new').click(function() {
            var wachtwoordVeld = $('#newpassword');
            var eyeIcon = $('#eyeIcon-new');

            // Toggle het invoertype van het wachtwoordveld
            if (wachtwoordVeld.attr('type') === 'password') {
                wachtwoordVeld.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                wachtwoordVeld.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
		
		$('#toggleWachtwoord-confirm').click(function() {
            var wachtwoordVeld = $('#passwordconfirm');
            var eyeIcon = $('#eyeIcon-confirm');

            // Toggle het invoertype van het wachtwoordveld
            if (wachtwoordVeld.attr('type') === 'password') {
                wachtwoordVeld.attr('type', 'text');
                eyeIcon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                wachtwoordVeld.attr('type', 'password');
                eyeIcon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
		
    });
</script>
