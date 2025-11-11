        <div class="container table-responsive">
            <form id="return-booking" action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <!--<input type="hidden" id="id" name="id" value="{{ $booking->id }}">-->
                <table class="table table-responsive-lg table-bordered" border="1">
					<thead>
						<th colspan="5"><b class="btn-grad">Return booking</b></th>
					</thead>
                    <tr>
                        <td><b>Date, Time </b></td>
                        <td colspan="2"> <input type="date" value="{{ $booking->pickup_date }}" id="datepicker"
                                required name="pickup_date" class="form-control datepicker"></td>
                        <td colspan="3"> <input type="time" value="{{ $booking->pickup_time }}" required
                                name="pickup_time" placeholder="HH:mm" class="form-control"></td>
                      
                    </tr>
                    <tr>
                        <td><b>Person(s), Luggage, Vehicle</b></td>
                        <td><input type="text" value="{{ $booking->press }}"  class="form-control" name="press"
                                id="press" placeholder="Enter No of Passenger"></td>
                        <td colspan="2"><input type="text"  value="{{ $booking->luggage }}" name="luggage"
                                id="luggage" class="form-control" placeholder="Enter No of Luggage"></td>
                        <td colspan="2"><select class="form-control" name="vehicle" id="vehicle">
                             <option value="Sedan" @if ($booking->vehicle === 'Sedan') selected @endif>Sedan</option>
								<option value="Stationwagen" @if ($booking->vehicle === 'Stationwagen') selected @endif>Stationwagen</option>
								<option value="Bus4" @if ($booking->vehicle === 'Bus4') selected @endif>Bus4</option>
								<option value="Bus5" @if ($booking->vehicle === 'Bus5') selected @endif>Bus5</option>
								<option value="Bus6" @if ($booking->vehicle === 'Bus6') selected @endif>Bus6</option>
								<option value="Bus7" @if ($booking->vehicle === 'Bus7') selected @endif>Bus7</option>
								<option value="Bus8" @if ($booking->vehicle === 'Bus8') selected @endif>Bus8</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td><b>From</b></td>
                        <td colspan="2"><input type="text" value="{{ $booking->destination }}"
                                class="form-control pg-autocomplete" required   name="pickup_address"
                                placeholder="Enter From"></td>
                        <td colspan="3"><input type="text" value="" placeholder="House/flight no"  class="form-control"
                                name="house_no_from" id="from1" required>
                        </td>
                    </tr>
                    <tr>
                        <td><b>To</b></td>
                        <td colspan="2"><input type="text" value="{{ $booking->pickup_address }}"
                                class="form-control pg-autocomplete" id="to" name="to"
                                placeholder="Enter Destination"></td>
                        <td colspan="3"><input type="text" value="{{ $booking->house_no_from }}" placeholder="To House No " class="form-control"
                                name="house_no_to" id="to1">
                        </td>
                    </tr>
                    <tr>
                        <td><b>Price (Customer,Taxi)</b></td>
                        <td>
						
						
						  <div class="input-group mb-2">
									<!--<div class="input-group-prepend">
									  <div class="input-group-text"><i class="fa-solid fa-euro-sign"></i></div>
									</div>-->
							  <input type="text" name="price" value="{{ $booking->price }}" id="price" class="form-control">
								
							</div>
						
						</td>
                        <td><input type="text" name="price1" value="{{ $booking->price1 }}" id="price1"
                                class="form-control"></td>
                        <td style="width:20%"><select name="mode" id="mode" class="form-control">
                                <option value="Cash" @if ($booking->mode === 'Cash') selected @endif>Cash</option>
                                <option value="On Account" @if ($booking->mode === 'On Account') selected @endif>On Account
                                </option>
                                <option value="Pin Payment" @if ($booking->mode === 'Pin Payment') selected @endif>Pin Payment
                                </option>
                                <option value="Credit Card" @if ($booking->mode === 'Credit Card') selected @endif>Credit Card
                                </option>                                
                                <option value="Remittance" @if ($booking->mode === 'Remittance') selected @endif>Remittance
                                </option>
                                <option value="No Payment" @if ($booking->mode === 'No Payment') selected @endif>No Payment
                                </option>
                            </select></td>
                       
                    </tr>
					
                    <tr>
                        <td><b>Mobile, E-mail</b></td>
                        <td colspan="1"><input type="text"  value="{{ $booking->phone }}"
                                class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number">
                        </td>
                        <td colspan="2"><input type="email"  value="{{ $booking->email }}"
                                class="form-control" name="email" id="email" placeholder="Enter E-mail"></td>
                        <td colspan="2"><input type="text" required name="uname" value="{{ $booking->name }}"
                                id="uname" class="form-control" placeholder="Enter Your Name"></td>
                    </tr>
					<tr>
						<td><b>Name, Company</b></td>
                        <td colspan="2"><input type="text" required name="uname" value="{{ $booking->name }}"
                                id="uname" class="form-control" placeholder="Enter Your Name"></td>
						<td colspan="1">
							<select class="select-driver" name="company" id="company" >
								<option value="" class="" >Choose a company</option>
								@foreach($companies as $company)
								<option value="{{ $company->naam }}">{{ $company->naam }}</option>
								@endforeach
							</select>
						</td>
					{{--	<td colspan="2"><select name="company" id="company" class="">
							<option value="-">-</option>
							<option value="Easy Rider" @if ($booking->company === 'Easy Rider') selected @endif>Easy Rider</option>
							<option value="Massive Music" @if ($booking->company === 'Massive Music') selected @endif>Massive Music</option>
							<option value="TCA" @if ($booking->company === 'TCA') selected @endif>TCA </option>
							<option value="Hans Brouwer Prive" @if ($booking->company === 'Hans Brouwer Prive') selected @endif>Hans Brouwer Prive</option>
							<option value="Joep Beving Sonderling b.v." @if ($booking->company === 'Joep Beving Sonderling b.v.') selected @endif>Joep Beving Sonderling b.v. </option>
							<option value="Stichting Holland Festival" @if ($booking->company === 'Stichting Holland Festival') selected @endif>Stichting Holland Festival</option>
							<option value="Wiser Globe" @if ($booking->company === 'Wiser Globe') selected @endif>Wiser Globe</option>
							<option value="Politie" @if ($booking->company === 'Politie') selected @endif>Politie</option>
							<option value="Kevlinx Holding BV" @if ($booking->company === 'Kevlinx Holding BV') selected @endif>Kevlinx Holding BV </option>
							<option value="Stichting Flamenco Biënnale" @if ($booking->company === 'Stichting Flamenco Biënnale') selected @endif>Stichting Flamenco Biënnale </option>
							<option value="Safar Limo Service" @if ($booking->company === 'Safar Limo Service') selected @endif>Safar Limo Service</option>
							<option value="Vereniging Hoge Scholen" @if ($booking->company === 'Vereniging Hoge Scholen') selected @endif>Vereniging Hoge Scholen</option>
							<option value="The Recess College" @if ($booking->company === 'The Recess College') selected @endif>The Recess College</option>
							</select></td> --}}
                    </tr>
                    {{-- <tr>
                        <td><b>Customer</b></td>
                        <td colspan="5"><input type="text" value="{{ $booking->customer }}" name="customer"
                                id="customer" class="form-control"></td>
                    </tr> --}}
                   
             
                    <tr>
                        <td><b>Remark</b></td>
                        <td colspan="5">
                            <textarea class="form-control" value="{{ $booking->remark }}" name="remark" id="remark"
                                placeholder="Enter Remark">{{ $booking->remark }}</textarea>
                        </td>
                    </tr>
					
					 <td><input class="form-control" name="return" id="choice" value="No" hidden></td>
					
                </table>
				<style>
						.rethide{
							display:none;
						}
						
				</style>
                <br />
				<div class="row" >
					<div>
						<button class="btn btn-primary"><a href="{{ url('/admin/bookings') }}" style="color:white;">Cancel</a></button>
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</div>
            </form>
        </div>
