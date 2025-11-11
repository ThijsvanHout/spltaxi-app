
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="brand-link" style="background: #fff;">
      <img src="{{ asset('images/logo.png') }}" class="brand-image" style="opacity: .8; float: none;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/admin') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
		  
          <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Bookings<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/bookings') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Bookings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/bookings/create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Booking</p>
                </a>
              </li>
              
            </ul>
          </li>
			<li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Invoice<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/invoice') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Invoice Driver</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/createinvoicecompany') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Invoice Company</p>
                </a>
              </li>              
            </ul>
          </li>
          <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-car"></i>
              <p>Drivers<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/drivers') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Drivers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/drivers/create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Driver</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('/admin/details') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Details</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-car"></i>
              <p>Companies<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('/admin/companies') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Companies</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('/admin/companies/add') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Company</p>
                </a>
              </li>            
            </ul>
          </li>	
		  <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-key nav-icon"></i>
              <p>User Admins <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
			  <li class="nav-item">
                <a href="{{ url('/admin/admins') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Admins</p>
                </a>
              </li>	  
              <li class="nav-item">
                <a href="{{ url('/admin/admins/add') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Admin</p>
                </a>
              </li>  
			</ul>
		  </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>