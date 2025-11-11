

<!-- Main Footer -->
<footer class="main-footer">
	
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.2/Sortable.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

<!-- Bootstrap -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!--<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDl5y2ApdvxYPlUKgXQnO7SdaYExoxA-AQ&libraries=places"></script>-->
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places"></script>


<!-- AdminLTE -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>


<script>
    google.maps.event.addDomListener(window, 'load', initAutocomplete);
  function initAutocomplete() {
    var options = {
        fields: ["formatted_address", "geometry", "name", "address_components", "icon"],
    };
	  
    var inputs = document.getElementsByClassName('pg-autocomplete');
    for (var i = 0; i < inputs.length; i++) {
        new google.maps.places.Autocomplete(inputs[i], options);
    }
    document.querySelector(".pg-track-location").addEventListener("click", function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
    });
  }
  function showPosition(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    var geocoder = new google.maps.Geocoder();
    var latLng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({ 'latLng': latLng }, function (results, status) {
      if (status === google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          document.getElementsByClassName('pg-autocomplete')[0].value = results[0].formatted_address;
        }
      }
    });
  }

  $(function () {
    $('#example5').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        dom: 'Bfrtip',
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });
	  
/*	 $(function () {
            $("#sortable").sortable({
                items: "tr",
                cursor: "move",
                update: function (event, ui) {
                    let order = [];
                    $("#sortable tr").each(function () {
                         order.push($(this).find("td").data("id"));
                    });
console.log("Order value:", order);
                    $.ajax({
                        url: "{{ route('drivers.update-order') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",_method: "PUT",  // Hiermee simuleren we een PUT-verzoek
                            order: order
                        },
                        success: function (response) {
                            console.log("Volgorde bijgewerkt!", response);
                        },
						error: function (xhr, status, error) {
							console.log("Fout bij update:", error);
							console.log("Response:", xhr.responseText);
						}
                    });
                }
            }).disableSelection();
        });
}); */
	
	$("#sortable").sortable({
        update: function(event, ui) {
            // Maak een lege array voor de chauffeur-ID's
            var order = [];
            
            // Voor elk tr element, haal het data-id attribuut op
            $("#sortable tr").each(function() {
                order.push($(this).data("id"));
            });
            
            // Log de nieuwe volgorde (optioneel)
            console.log("Nieuwe volgorde:", order);
            
            // Zet de gesorteerde chauffeur-ID's als een komma-gescheiden string in de hidden input
            $("#orderInput").val(order.join(","));
            
            // Submit de form
            $("#orderForm").submit();
        }
    });
	  
	/*document.addEventListener("DOMContentLoaded", function () {
		var el = document.getElementById("sortable");

		new Sortable(el, {
			animation: 150,
			handle: ".drag-handle",
			onEnd: function (evt) {
				let order = [];
				document.querySelectorAll("#sortable tr").forEach((row, index) => {
					let driverId = row.dataset.id; // Haal de ID op uit de data-attribuut
					order.push({ id: driverId, order: index + 1 }); // Nieuwe volgorde
				});

				console.log("Nieuwe volgorde:", order); // Check in console

				// Stuur de nieuwe volgorde naar de server
				fetch("{{ route('drivers.update-order') }}", {
					method: "POST",
					headers: {
						"Content-Type": "application/json",
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					},
					body: JSON.stringify({ order: order })
				})
					.then(response => response.json())
					.then(data => console.log("Volgorde bijgewerkt:", data))
					.catch(error => console.error("Fout:", error));
			}
		});
	}); */

  });
</script>
<script>
$(function () {
 
  // $('#add-driver-form').validate({
  //   submitHandler: function () {
  //     alert( "Driver form successfully submitted!" );
  //   },
  //   rules: {
  //     name: {
  //       required: true,
  //       minlength: 2
  //     },
  //     email: {
  //       required: true,
  //       email: true,
  //     },
  //     phone: {
  //       required: true,
  //       minlength: 10,
  //       maxlength: 10,
  //       digits: true
  //     },
  //     address: {
  //       required: true,
  //     },
  //     car_number: {
  //       required: true
  //     },
  //   },
  //   messages: {
  //     name: {
  //       required: "Please enter a name",
  //       minlength: "Your name must consist of at least 2 characters"
  //     },
  //     email: {
  //       required: "Please enter an email",
  //       email: "Please enter a valid email"
  //     },
  //     phone: {
  //       required: "Please provide a phone number",
  //       minlength: "Your phone number must be exactly 10 digits",
  //       maxlength: "Your phone number must be exactly 10 digits",
  //       digits: "Please enter only digits"
  //     },
  //     address: {
  //       required: "Please provide an address"
  //     },
  //     car_number: {
  //       required: "Please provide a car number"
  //     },
  //   },
  //   errorElement: 'span',
  //   errorPlacement: function (error, element) {
  //     error.addClass('invalid-feedback');
  //     element.closest('.form-group').append(error);
  //   },
  //   highlight: function (element, errorClass, validClass) {
  //     $(element).addClass('is-invalid');
  //   },
  //   unhighlight: function (element, errorClass, validClass) {
  //     $(element).removeClass('is-invalid');
  //   }
  // });
});



$(function () {
 
  // $('#add-booking-form').validate({
  //   submitHandler: function () {
  //     alert( "Booking form successfully submitted!" );
  //   },
  //   rules: {
  //     name: {
  //       required: true,
  //       minlength: 2
  //     },
  //     email: {
  //       required: true,
  //       email: true,
  //     },
  //     phone: {
  //       required: true,
  //       minlength: 10,
  //       maxlength: 10,
  //       digits: true
  //     },
  //     pickup_address: {
  //       required: true,
  //     },
  //     no_of_persons: {
  //       required: true,
  //       digits: true
  //     },
  //     pickup_date: {
  //       required: true,
  //       date: true
  //     },
  //     pickup_time: {
  //       required: true
  //     },
  //     destination: {
  //       required: true
  //     },
  //   },
  //   messages: {
  //     name: {
  //       required: "Please enter a name",
  //       minlength: "Your name must consist of at least 2 characters"
  //     },
  //     email: {
  //       required: "Please enter an email",
  //       email: "Please enter a valid email"
  //     },
  //     phone: {
  //       required: "Please provide a phone number",
  //       minlength: "Your phone number must be exactly 10 digits",
  //       maxlength: "Your phone number must be exactly 10 digits",
  //       digits: "Please enter only digits"
  //     },
  //     pickup_address: {
  //       required: "Please provide a pickup address"
  //     },
  //     no_of_persons: {
  //       required: "Please enter the number of persons",
  //       digits: "Please enter a valid number"
  //     },
  //     pickup_date: {
  //       required: "Please provide a pickup date",
  //       date: "Please enter a valid date"
  //     },
  //     pickup_time: {
  //       required: "Please provide a pickup time",
  //     },
  //     destination: {
  //       required: "Please provide a destination",
  //     },
  //   },
  //   errorElement: 'span',
  //   errorPlacement: function (error, element) {
  //     error.addClass('invalid-feedback');
  //     element.closest('.form-group').append(error);
  //   },
  //   highlight: function (element, errorClass, validClass) {
  //     $(element).addClass('is-invalid');
  //   },
  //   unhighlight: function (element, errorClass, validClass) {
  //     $(element).removeClass('is-invalid');
  //   }
  // });
});

</script>
<script>
  $('#assignDriverForm').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: '{{ route('admin/assign-driver') }}',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            // Close the modal
            $('#assignDriverModal').modal('hide');
            if(response.message == "Driver assigned successfully"){
              window.location.reload(); 
            }
            // Show a success message or refresh the page
            // alert(url);
        }
    });
});
</script>
<script>
  $(document).ready(function() {
  $('.assign-btn').on('click',function() {
    var bookingId = $(this).data('id');
    console.log(bookingId,"=====wewewew")
    $('#assignDriverModal #booking_id').val(bookingId);
  });
});

  </script>

<script>
       
    </script>
 
</body>
</html>
