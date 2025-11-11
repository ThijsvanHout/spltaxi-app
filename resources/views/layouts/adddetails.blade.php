@extends('layouts.app')

@section('main-section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add Details</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::has('danger'))
                <div class="alert alert-danger">
                    {{ Session::get('danger') }}
                </div>
            @endif
            <div class="container-fluid well">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-10">
                        <!-- jquery validation -->
                        <div class="card card-primary">

                            <!-- form start -->

                            <form id="details-form" method="POST" action="{{ route('details.save') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Start To Destination</label>
                                        <input type="text" name="std" class="form-control" id="std"
                                            placeholder="eg-Uithoorn naar Schiphol en retour" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Vehicle & Price</label>
                                        <input type="text" name="vp" class="form-control" id="vp"
                                            placeholder="eg-Auto € 35,00" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Person & Luggage</label>
                                        <input type="text" name="pl" class="form-control" id="pl"
                                            placeholder="eg-(3 Personen 3 koffers / 4 Personen 4 trolleys)" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Pickup Place</label>
                                        <input type="text" name="pp" class="form-control" id="pp"
                                            placeholder="eg-Vanaf Station € 37,50" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="car_number">Min. Person</label>
                                        <input type="text" name="min_person" class="form-control" id="min_person"
                                            placeholder="eg-Bus tot 6 Personen € 40,00" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="car_number">Max Person</label>
                                        <input type="text" name="max_person" class="form-control" id="max_person"
                                            placeholder="eg-Bus tot 8 Personen € 45,00" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="car_number">Page Details</label>
                                        {{-- <input type="text" name="max_person" class="form-control" id="max_person" placeholder="eg-Bus tot 8 Personen € 45,00" required > --}}
                                        <select class="form-control" id="page_name" name="page_name" required>
                                            <option value="">Select Page For Details</option>
                                            <option value="aalsmeer">Aalsmeer</option>
                                            <option value="abcoude">Abcoude</option>
                                            <option value="amsterdam">Amsterdam</option>
                                            <option value="diemen">Diemen</option>
                                            <option value="duivendrecht">Duivendrecht</option>
                                            <option value="haarlem">Haarlem</option>
                                            <option value="ouderkerk">Ouderkerk</option>
                                            <option value="uithoorn">Uithoorn</option>


                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <center><button type="submit" class="btn btn-success">Submit</button></center>
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
            </div><!-- /.container-fluid --><br>
           <div class="container well">
            <center><h2>Page Details</h2></center>
            <table class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                      <th>Start To Destination</th>
                      <th>Vehicle Price</th>
                      <th>Person & Luggage</th>
                      <th>Pickup Place</th>
                      <th>Minimum Person</th>
                      <th>Maximum Person</th>
                      <th>Page Name</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($data as $item)
                  <tr>
                      <td>{{ $item->start_to_destination }}</td>
                      <td>{{ $item->vehicle_price }}</td>
                      <td>{{ $item->person_luggage }}</td>
                      <td>{{ $item->pickup_place }}</td>
                      <td>{{ $item->min_person }}</td>
                      <td>{{ $item->max_person }}</td>
                      <td>{{ $item->page_name }}</td>
                      
                      <td>
                        <div class="d-flex justify-content-between">
                          <a href="#" class="edit-btn" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('details.destroy') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $item->id }}" name="id">
                            <button type="submit" class="btn btn-link delete-btn" style="margin-top:-8px;"><i class="fas fa-trash-alt"></i></button>
                        </form>
                      </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>

         <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
          <form id="editForm" action="{{ route('details.update') }}" method="post">
              @csrf
             
              <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">Edit Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <input type="hidden" id="editItemId" name="id">
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="start_to_destination">Start To Destination:</label>
                          <input type="text" class="form-control" id="start_to_destination" name="start_to_destination" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="vehicle_price">Vehicle Price:</label>
                          <input type="text" class="form-control" id="vehicle_price" name="vehicle_price" required>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="person_luggage">Person & Luggage:</label>
                          <input type="text" class="form-control" id="person_luggage" name="person_luggage" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="pickup_place">Pickup Place:</label>
                          <input type="text" class="form-control" id="pickup_place" name="pickup_place" required>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-6">
                          <label for="min_person">Minimum Person:</label>
                          <input type="text" class="form-control" id="minperson" name="min_person" required>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="max_person">Maximum Person:</label>
                          <input type="text" class="form-control" id="maxperson" name="max_person" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="page_name">Page Name:</label>
                      <input type="text" class="form-control" id="pagename" name="page_name" readonly required>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
          </form>
      </div>
  </div>
</div>


        
        <script>
          document.addEventListener("DOMContentLoaded", function() {
              const editButtons = document.querySelectorAll('.edit-btn');
              const editModal = document.getElementById('editModal');
              const editForm = document.getElementById('editForm');
              const editItemId = document.getElementById('editItemId');
              
      
              // Edit Button Click Event
              editButtons.forEach(button => {
                  button.addEventListener('click', () => {
                      const row = button.closest('tr');
                      editItemId.value = button.getAttribute('data-id');
      
                      // Get the values from the row cells
                      const startToDestination = row.querySelector('td:nth-child(1)').innerText.trim();
                      const vehiclePrice = row.querySelector('td:nth-child(2)').innerText.trim();
                      const personLuggage = row.querySelector('td:nth-child(3)').innerText.trim();
                      const pickupPlace = row.querySelector('td:nth-child(4)').innerText.trim();
                      const minPerson = row.querySelector('td:nth-child(5)').innerText.trim();
                      const maxPerson = row.querySelector('td:nth-child(6)').innerText.trim();
                      const pageName = row.querySelector('td:nth-child(7)').innerText.trim();
      
                      // Populate the input fields with the data
                      document.getElementById('start_to_destination').value = startToDestination;
                      document.getElementById('vehicle_price').value = vehiclePrice;
                      document.getElementById('person_luggage').value = personLuggage;
                      document.getElementById('pickup_place').value = pickupPlace;
                      document.getElementById('minperson').value = minPerson;
                      document.getElementById('maxperson').value = maxPerson;
                      document.getElementById('pagename').value = pageName;
                     
      
                    
                      // Show the modal
                      $(editModal).modal('show');
                  });
              });
          });
      </script>

      
        </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
