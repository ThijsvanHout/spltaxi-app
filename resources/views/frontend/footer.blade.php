</div> 
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="fot-links">
                    <ul>
                        <li><a href="#">SCHIPHOL TAXI FROM / TO</a></li>
                        <li><a href="https://www.spl.taxi/schiphol-taxi/amstelveen/">AMSTELVEEN</a></li>
                        <li><a href="https://spl.taxi/schiphol-taxi/abcoude/">ABCOUDE</a></li>
                        <li><a href="https://spl.taxi/schiphol-taxi/amsterdam/">AMSTERDAM</a></li>
                        <li><a href="https://www.spl.taxi/schiphol-taxi/hoofddorp/">HOOFDDORP</a></li>
                        <li><a href="https://spl.taxi/schiphol-taxi/duivendrecht/">DUIVENDRECHT</a></li>
                        <li><a href="#">AND MANY MORE LOCATIONS</a></li>


                 
                        
                
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="fot-city">
                    <ul>
                        <li><a href="https://www.spl.taxi/"><img src="{{ asset('frontend/images/nl.png') }}"> Nederlands</a></li>
                        <li><a href="https://www.spl.taxi/en/"><img src="{{ asset('frontend/images/en.png') }}"> English (Engels)</a></li>
                        <li><a href="https://www.spl.taxi/he/"><img src="{{ asset('frontend/images/he.png') }}"> עברית (Hebreeuws)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


//<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
/*<script async src="https://maps.googleapis.com/maps/api/jskey=AIzaSyDl5y2ApdvxYPlUKgXQnO7SdaYExoxA-AQ&libraries=places&callback=initAutocomplete"></script>*/

<script async
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvebq2jX4RZusozpW8CFlQHtfVEIZkuRg&libraries=places&callback=initAutocomplete">
</script>

<script>
	console.log('Script geladen');
    $(document).ready(function() {
		/*$('#add-button').on('click', function(event) {
			event.preventDefault();
			console.log('Submit button clicked');
			var formData = $(this).serialize();

			// AJAX-verzoek om het formulier te verzenden
			var csrfToken = $('meta[name="csrf-token"]').attr('content');

			// Stel de CSRF-token in voor alle AJAX-aanroepen
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': csrfToken
				}
			});
			
			$.ajax({
				url: $(this).attr('action'),
				method: 'POST',
				data: formData,
				success: function(response) {
					if (response.success) {
						// Pop-up of modal weergeven
						//$('#booking-info').text('Naam: ' + response.booking.name + ', Datum: ' + response.booking.date + ', Tijd: ' + response.booking.time);
						//$('#successModal').modal('show'); // Voor Bootstrap modals
						// Of gebruik een alert
						alert('Boeking succesvol opgeslagen!');
					}
					else {
						alert(response);
					}
				},
				error: function(response) {
					alert('Er is een fout opgetreden bij het opslaan van de boeking.');
				}
			});

   	 	}); */
		// $( "#datepicker" ).datepicker({
        //     todayHighlight: true,
        //     minDate: new Date(),
        //     dateFormat: 'DD-MM-YYYY',
        // });
        AOS.init();
        
        $('#navbarSideButton').on('click', function() {
        $('#navbarSide').addClass('reveal');
        $('.overlay').show();
        });

        $('.overlay').on('click', function(){
        $('#navbarSide').removeClass('reveal');
        $('.overlay').hide();
        });
        
        //Header scroll add class
      $(window).scroll(function() {    
          var scroll = $(window).scrollTop();    
          if (scroll <= 0) {

              $(".headertop").removeClass("f-height");
          }else{
                $(".headertop").addClass("f-height");
          }
      });

    });

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
	


document.getElementById('return-flight').addEventListener('change', function() {
    document.getElementById('return-flight-info').style.display = this.checked ? 'block' : 'none';
    document.getElementById('date_return_flight').required = this.checked ? true : false;
    document.getElementById('flight_no_on_return').required = this.checked ? true : false;
});
	

        
</script>


</body>
</html>


