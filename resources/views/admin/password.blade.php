@extends('layouts.app')

@section('main-section')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Change password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-md-12"> <!-- left column -->
            <!-- jquery validation -->
            <div class="card card-primary">
                @if(session('error'))
					<div class="alert alert-danger">
						{{ session('error') }}
					</div>
				@endif
              	
				<form method="POST" action="{{ route('admin.password') }}" autocomplete="off">
					@csrf
					
					<div class="card-body">
						<div class="form-group">
							<label for="email">Email</label>							
							<input type="email" name="email" class="form-control" id="email" value="{{ $admin->email }}" placeholder="Enter email">
							@error('email')
          						<span id="exampleInputEmail1-error" style="display:block" class="error invalid-feedback">{{ $message }}</span>
							@enderror
						</div>
						<div class="form-group">
							<label for="passsword">Old password</label>
							<div class="input-group">								
								<input type="password" name="password" class="form-control" id="password" placeholder="Enter old password" autocomplete="new-password">
								<div class="input-group-append">
									<span class="input-group-text" id="toggleWachtwoord-old">
										<i class="fas fa-eye" id="eyeIcon"></i>
									</span>
								</div>
							</div>
							@error('password')
          						<span id="exampleInputEmail1-error" style="display:block" class="error invalid-feedback">{{ $message }}</span>
							@enderror
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
					</div>  <!-- /.card-body -->
					
					<div class="card-footer">
						<button class="btn btn-primary"><a href="{{ url('/admin/admins') }}" style="color:white;">Cancel</a></button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>

			</div>  <!-- /.card -->
           
          </div> <!--/.col (left) -->
          
          <!-- right column -->
          <div class="col-md-6">

          </div> <!--/.col (right) -->
          
        </div> <!-- /.row -->
        
      </div> <!-- /.container-fluid -->
    </section> <!-- /.content-header -->
    
  </div> <!-- /.content-wrapper -->
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

  