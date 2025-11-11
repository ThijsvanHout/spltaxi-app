@extends('layouts.app')

@section('main-section')
	<div class="content-wrapper">
		<form id="edit-user-receipt" method="POST" >
			<h3>Booking receipt</h3>
			<table class="table table-responsive-lg table-bordered" border="1" style="table-layout:fixed; width:100%;">
				<tbody>
					<tr>
						<td><label>Name</label></td>
						<td hidden><input type="text" value="{{ $booking->name }}" readonly></td>
						<td>{{ $booking->name }} </td>
					</tr>
					<tr>
						<td><label>Email</label></td>
						<td><input type="email" value="{{ $booking->email }}" name="email"></td>
					</tr>
					<tr>
						<td><label>Pickup Address</label></td>
						<td hidden><input class="form=control" type="text" value="{{ $booking->pickup_address }}" readonly></td>
						<td>{{ $booking->pickup_address }}</td>
					</tr>
					<tr>
						<td><label>Destination</label></td>
						<td hidden><input type="text" value="{{ $booking->destination }}" readonly></td>
						<td>{{ $booking->destination }}</td>
					</tr>
					<tr>
						<td><label>Number of Persons</label></td>
						<td hidden><input type="text" value="{{ $booking->press }}" readonly></td>
						<td>{{ $booking->press }}</td>
					</tr>
					<tr>
						<td><label>Date</label></td>
						<td hidden><input type="text" value="{{ $booking->pickup_date }}" readonly></td>
						<td>{{ $booking->pickup_date }}</td>
					</tr>
					<tr>
						<td><label>Time</label></td>
						<td hidden><input type="text" value="{{ $booking->pickup_time }}" readonly></td>
						<td>{{ $booking->pickup_time }}</td>
					</tr>
					<tr>
						<td><label>Price</label></td>
						<td><input type="number" step="0.01" value="{{ $booking->price }}"></td>
					</tr>
				</tbody>
				<tfooter>
					<tr>
						<td><button type="submit">Verzend email<//button>
					</tr>
				</tfooter>
			</table>
		</form>
	</div>
@endsection			
		