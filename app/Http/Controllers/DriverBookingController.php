<?php

namespace App\Http\Controllers;

use App\Models\DriverBooking;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class DriverBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $driverBooking = DriverBooking::create([
            'driver_id' => $request->driver_id,
            'booking_id' => $request->booking_id,
            'status' => 'Pending'
        ]);
        if (isset($driverBooking)) {
            // Retrieve the booking and update its status and driver_id
            $booking = Booking::findOrFail($request->booking_id);
            $booking->status = 'Assigned';
            $booking->assign_id = $driverBooking->id;
            $booking->save();
            Session::flash('success', 'Driver assigned successfully');

            return response()->json(['message' => 'Driver assigned successfully'], 200);
        } else {
            Session::flash('success', 'Driver assignment failed');
            return response()->json(['message' => 'Driver assignment failed'], 500);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = DB::table('bookings')
        ->where('bookings.assign_id', '=', $id)
        ->select('*')
        ->first();
        return view('frontend.driverconfirmation', compact('booking'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserConfirmation($id)
    {
        $booking = DB::table('driver_booking')
        ->where('driver_booking.id', '=', $id)
        ->leftJoin('drivers','driver_booking.driver_id','=','drivers.id')
        ->leftJoin('bookings','driver_booking.id','=','bookings.assign_id')
        ->select('drivers.name as driver_name','drivers.email as driver_email','drivers.car_number','drivers.phone as driver_phone','bookings.*')
        ->first();
        return view('frontend.userconfirmation', compact('booking'));
    }

	public function showUserReceipt($id)
    {
        $booking = DB::table('driver_booking')
        ->where('driver_booking.id', '=', $id)
        ->leftJoin('drivers','driver_booking.driver_id','=','drivers.id')
        ->leftJoin('bookings','driver_booking.id','=','bookings.assign_id')
        ->select('drivers.name as driver_name','drivers.email as driver_email','drivers.car_number','drivers.phone as driver_phone','bookings.*')
        ->first();
        return view('frontend.userreceipt', compact('booking'));
    }
	
	public function userReceiptEdit($id)
    {
        $booking = DB::table('driver_booking')
        ->where('driver_booking.id', '=', $id)
        ->leftJoin('drivers','driver_booking.driver_id','=','drivers.id')
        ->leftJoin('bookings','driver_booking.id','=','bookings.assign_id')
        ->select('drivers.name as driver_name','drivers.email as driver_email','drivers.car_number','drivers.phone as driver_phone','bookings.*')
        ->first();
		
		return view('layouts.userreceiptedit', compact('booking'));
    }
    
	public function userReceiptEmail($id)
    {
        $booking = DB::table('driver_booking')
        ->where('driver_booking.id', '=', $id)
        ->leftJoin('drivers','driver_booking.driver_id','=','drivers.id')
        ->leftJoin('bookings','driver_booking.id','=','bookings.assign_id')
        ->select('drivers.name as driver_name','drivers.email as driver_email','drivers.car_number','drivers.phone as driver_phone','bookings.*')
        ->first();
		
		Mail::send('layouts.userreceiptemail', ['booking' => $booking], function($message) use ($booking) {
			$message->to('blackhout@upcmail.nl')
					->subject('Bevestiging van je boeking');
		});

		return redirect('/admin/bookings')
        ->with('success', 'Bevestiging is verzonden!');  //redirect naar url /admin/bookings
    }
	
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function respondBooking(Request $request, $id)
    {
        $booking = Booking::where('assign_id', $id)->firstOrFail();
        $status = $request->input('status');
        
        if ($status == 'accepted') {
            $booking->status = 'Accepted';
            $message = 'Booking Accepted Successfully!';
        } else if ($status == 'rejected') {
            $booking->status = 'Rejected';
            $message = 'Booking Rejected Successfully!';
        }

        $booking->save();

        // Flash the success message to the session
        $request->session()->flash('status', $message);

        // return back to the same page
        return back();
    }


}
