<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Company;
use App\Models\Prices_per_city;
use App\Models\DriverBooking;
use App\Models\WhatsappMessage;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\BookingConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class BookingController extends Controller
{
	
	
    public function index()
    {
        $yesterday = Carbon::yesterday();
        $datetoday = $yesterday->toDateString();
        // $bookings = Booking::all();
        /*  $bookings = Booking::select('bookings.*', 'drivers.name as driver_name')
              ->leftJoin('driver_booking', 'bookings.id', '=', 'driver_booking.booking_id')
              ->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
              ->where('pickup_date', '>', $datetoday)
              ->orderBy('pickup_date', 'ASC')
              ->orderBy('pickup_time', 'ASC')
              ->get(); */
/*
$bookings = Booking::select('bookings.*', 
                                  'drivers.name as driver_name', 
                                  'bookings.pickup_date as date', 
                                  'bookings.pickup_time as time',
                                  'returnBooking.pickup_date as return_pickup_date',
                                  'returnBooking.pickup_time as return_pickup_time')
    ->leftJoin('driver_booking', 'bookings.id', '=', 'driver_booking.booking_id')
    ->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
    ->leftJoin('bookings as returnBooking', function($join) {
        $join->on('bookings.return_id', '=', 'returnBooking.id')
             ->where('bookings.return_flight', '=', 'YES');
    })
    ->where('bookings.pickup_date', '>', $datetoday)
	->where('bookings.status', '<>', 'Completed')
    ->orderBy('bookings.pickup_date', 'ASC')
    ->orderBy('bookings.pickup_time', 'ASC')
    ->get(); */
$bookings = Booking::select('bookings.*', 
                            'drivers.name as driver_name', 
							'drivers.phone as driver_phone', 
                            'bookings.pickup_date as date', 
                            'bookings.pickup_time as time')
    ->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
    ->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
    ->where('bookings.pickup_date', '>', $datetoday)
    ->where('bookings.status', '<>', 'Completed')
	->orderBy('bookings.pickup_date', 'ASC')
    ->orderBy('bookings.pickup_time', 'ASC')
    ->get();

		
		/*
        $pickupBookings = Booking::select('bookings.*', 'drivers.name as driver_name', 'bookings.pickup_date as date', 'bookings.pickup_time as time')
            ->leftJoin('driver_booking', 'bookings.id', '=', 'driver_booking.booking_id')
            ->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
            ->where('pickup_date', '>', $datetoday)
            ->orderBy('pickup_date', 'ASC');

      $returnBookings = Booking::select('bookings.*', 'drivers.name as driver_name', 'bookings.date_return_flight as date', 'bookings.pickup_time as time')
            ->leftJoin('driver_booking', 'bookings.id', '=', 'driver_booking.booking_id')
            ->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
            ->where('date_return_flight', '>', $datetoday)
            ->orderBy('date_return_flight', 'ASC');

		
        $bookings = $pickupBookings->union($returnBookings)
            ->orderBy('date', 'ASC')
            ->orderBy('time', 'ASC')
            ->get();
*/
        //$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();
		
		$companies = Company::all();		
		

        //  print_r($bookings);
        return view('layouts.bookings', ['bookings' => $bookings, 'drivers' => $drivers, 'companies' => $companies]);
    }
    public function create()
    {				
        return view('layouts.addbookings');
    }
	
	public function adminstore(Request $request)
    {		
        $bookings = new Booking();
        $bookings->name = $request['uname'];
        $bookings->email = $request['email'];
        $bookings->phone = $request['mobile'];
		$bookings->company = $request['company'];

        $bookings->pickup_address = $request['pickup_address'];
		if (strpos(strtolower($request['pickup_address']), 'schiphol') !== false){	
			$bookings->house_no_from = $request['flight_no'];
		} else {
			$bookings->house_no_from = $request['house_no_from'];
		}
        $bookings->destination = $request['to'];
        $bookings->house_no_to = $request['house_no_to'];

        $bookings->pickup_date = $request['pickup_date'];
        $bookings->pickup_time = $request['pickup_time'];


        $bookings->press = $request['press'];
        $bookings->luggage = $request['luggage'];
        $bookings->vehicle = $request['vehicle'];
     	$bookings->price = $request['price'] ?? '';
		$bookings->price1 = $request['price1'] ?? '';


        $bookings->mode = $request['mode'];
        $bookings->km = $request['km'];
        $bookings->min = $request['min'];
		
        $bookings->remark = $request['remark'];
		/*if (strpos(strtolower($request['pickup_address']), 'schiphol') !== false){
			$bookings->flight_no_on_return = $request['flight_no'];
		}*/

        $bookings->return_flight = $request['return'];


        if ($request['return'] === 'Yes') {
			$bookings->date_return_flight = $request['flight_date'];
			$bookings->time_return_flight = $request['flight_time'];
			$bookings->flight_no_on_return = $request['flight_no_on_return'];
            $returnbookings = new Booking();
            $returnbookings->name = $request['uname'];
            $returnbookings->email = $request['email'];
            $returnbookings->phone = $request['mobile'];			
			$returnbookings->company = $request['company'];
            $returnbookings->pickup_address = $request['to'];
			if (strpos(strtolower($request['to']), 'schiphol') !== false){
				$returnbookings->house_no_from = $request['flight_no_on_return'];
			}
			else {
				$returnbookings->house_no_from = $request['house_no_to'];
			}
            $returnbookings->destination = $request['pickup_address'];
            $returnbookings->house_no_to = $request['house_no_from'];
            $returnbookings->pickup_date = $request['flight_date'];
            $returnbookings->pickup_time = $request['flight_time'];
			if ($request['flight_no_on_return']){
				$returnbookings->flight_no_on_return = $request['flight_no_on_return'];
			} 
            $returnbookings->press = $request['press'];
            $returnbookings->luggage = $request['luggage'];
            $returnbookings->vehicle = $request['vehicle'];
          	$returnbookings->price = $request['price'] ?? '';
			$returnbookings->price1 = $request['price1'] ?? '';
            
            $returnbookings->mode = $request['mode'];
            $returnbookings->km = $request['km'];
            $returnbookings->min = $request['min'];
       
            $returnbookings->remark = $request['returnremark'];
			
			
            $returnbookings->save();
            $bookings->return_id = $returnbookings->id;
	
            $bookings->save();
        } else {
            $bookings->save();
        }
		
		/*$bookingDetails = $request->all();*/
		$bookingDetails = $request->except(['price1']);
        Mail::to($request->input('email'))->cc('info@spl.taxi')->send(new BookingConfirmation($bookingDetails));
        Session::flash('success', 'Booking created successfully!');
				
	/*	if ($request['driver_id'] !== null){			
			$driverBooking = DriverBooking::create([
				'driver_id' => (int) $request->driver_id,
				'booking_id' => $bookings->id,
				'status' => 'Pending'
			]);
			if (isset($driverBooking)) {
				// Retrieve the booking and update its status and driver_id
				$booking = Booking::findOrFail($bookings->id);
				$booking->status = 'Assigned';
				$booking->assign_id = $driverBooking->id;
				$booking->save();
				Session::flash('success', 'Driver assigned successfully');
				return redirect()->route('bookings.index');				
			} else {
				return redirect()->route('bookings.index');
			}

		} */
		if ($request->filled('driver_id')) {

			DB::transaction(function () use ($request, $bookings) {
				// nieuwe driver_booking aanmaken
				$driverBooking = DriverBooking::create([
					'driver_id' => (int) $request->driver_id,
					'booking_id' => $bookings->id,
					'status' => 'Pending'
				]);
				
				// koppeling naar booking pas zetten bij nieuwe aanmaak
				$bookings->status = 'Assigned';
				$bookings->assign_id = $driverBooking->id;
				$bookings->save();							
			});
			
			Session::flash('success', 'Driver assigned successfully');
			return redirect()->route('bookings.index');	
		}
		else {
			return redirect()->route('bookings.index');
		}
		
		
         /*return redirect()->back(); */
		/*return redirect ("https://www.spl.taxi");*/
    }

    public function store(Request $request)
    {
        session_start();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			
			$captcha = $_POST["captcha"];

			// Controleer of de CAPTCHA in de sessie staat
			if (!isset($_SESSION['captcha_antwoord'])) {
				die("Fout: CAPTCHA niet ingesteld. Probeer opnieuw.");
			}

			// Controleer het antwoord
			if ($captcha == $_SESSION['captcha_antwoord']) {
				
			
				$bookings = new Booking();
				$bookings->name = $request['uname'];
				$bookings->email = $request['email'];
				$bookings->phone = $request['mobile'];		
				$bookings->company = $request['company'];

				$bookings->pickup_address = $request['pickup_address'];
				$bookings->house_no_from = $request['house_no_from'];
				$bookings->destination = $request['to'];
				$bookings->house_no_to = $request['house_no_to'];

				$bookings->pickup_date = $request['pickup_date'];
				$bookings->pickup_time = $request['pickup_time'];


				$bookings->press = $request['press'];
				$bookings->luggage = $request['luggage'];
				$bookings->vehicle = $request['vehicle'];
				$bookings->price = $request['price'] ?? '';
				if (str_contains(strtolower($bookings->pickup_address), 'schiphol') || str_contains(strtolower($bookings->destination), 'schiphol')) {
					if (str_contains(strtolower($bookings->pickup_address), 'schiphol')) {
						// Opsplitsen op komma
						$delen = explode(',', $bookings->destination);

						// Plaats is het tweede element (index 1)
						$plaats = trim($delen[1]); // Opsplitsen op komma
						
						if (str_contains($plaats, 'Ouderkerk')){
							$plaats = 'Ouderkerk';
						}

						$price = Prices_per_city::whereRaw('LOWER(plaats) = ?', [strtolower($plaats)])->first();
					}
					else {
						// Opsplitsen op komma
						$delen = explode(',', $bookings->pickup_address);

						// Plaats is het tweede element (index 1)
						$plaats = trim($delen[1]); // Opsplitsen op komma
						
						if (str_contains($plaats, 'Ouderkerk')){
							$plaats = 'Ouderkerk';
						}

						$price = Prices_per_city::whereRaw('LOWER(plaats) = ?', [strtolower($plaats)])->first();
					}

					if ($price){
						switch($bookings->vehicle){
							case 'Sedan' :
								$bookings->price = $price->sedan;
								break;
							case 'Stationwagen' :
								$bookings->price = $price->station;
								break;
							case 'Bus4' :
							case 'Bus5' :
							case 'Bus6' :
								$bookings->price = $price->bus_6;
								break;
							case 'Bus7' :
							case 'Bus8' :
								$bookings->price = $price->bus_8;
								break;
						}
					} 
				} 
								
				$bookings->price1 = $request['price1'] ?? '';

				$bookings->mode = $request['mode'];
				$bookings->km = $request['km'];
				$bookings->min = $request['min'];



				$bookings->remark = $request['remark'];
				if (strpos(strtolower($request['pickup_address']), 'schiphol') !== false){
					$bookings->flight_no_on_return = $request['house_no_from'];
				}

				$bookings->return_flight = $request['return'];



				if ($request['return'] === 'Yes') {
					$returnbookings = new Booking();
					$returnbookings->name = $request['uname'];
					$returnbookings->email = $request['email'];
					$returnbookings->phone = $request['mobile'];
					$returnbookings->company = $request['company'];
					$returnbookings->pickup_address = $request['to'];
					$returnbookings->house_no_from = $request['house_no_to'];
					$returnbookings->destination = $request['pickup_address'];
					$returnbookings->house_no_to = $request['house_no_from'];
					$returnbookings->pickup_date = $request['flight_date'];
					$returnbookings->pickup_time = $request['flight_time'];
					$returnbookings->flight_no_on_return = $request['flight_no'];
					$returnbookings->press = $request['press'];
					$returnbookings->luggage = $request['luggage'];
					$returnbookings->vehicle = $request['vehicle'];
					$returnbookings->price = $request['price'] ?? '';
					$returnbookings->price1 = $request['price1'] ?? '';

					$returnbookings->mode = $request['mode'];
					$returnbookings->km = $request['km'];
					$returnbookings->min = $request['min'];

					$returnbookings->remark = $request['returnremark'];

					$returnbookings->save();
					$bookings->return_id = $returnbookings->id;

					$bookings->save();
				} else {
					$bookings->save();
				}

				/*$bookingDetails = $request->all();*/
				$bookingDetails = $request->except(['price1']);
				if ($bookings->price){
					$bookingDetails['price'] = $bookings->price;
				}
				Mail::to($request->input('email'))->cc('info@spl.taxi')->send(new BookingConfirmation($bookingDetails));
				//Session::flash('success', 'Booking created successfully!');

				$referer = $request->headers->get('referer');

				// Controleer of de referentie-URL overeenkomt met de verwachte URL
				if ($referer && strpos($referer, 'https://reserve.spl.taxi/admin/') !== false) {
					return redirect()->route('bookings.index');            
				} 		
				else {	
					if ($request['return'] === 'Yes') {
						return view('frontend.intermediate', ['booking' => $bookings, 'returnbooking' => $returnbookings])->with('message', 'Booking created successfully!');
					}
					else {
						return view('frontend.intermediate', ['booking' => $bookings])->with('message', 'Booking created successfully!');
					}
					//return redirect ("https://www.spl.taxi");
				}	
		} else {
				echo "Fout: CAPTCHA is incorrect. Probeer opnieuw.";
			}	

			// Verwijder de CAPTCHA uit de sessie om hergebruik te voorkomen
			unset($_SESSION['captcha_antwoord']);
		}

		/*return redirect()->route('bookings.index');*/
         /*return redirect()->back(); */
		/*return redirect ("https://www.spl.taxi");*/
    }

    public function edit(Booking $booking)
    {
		//$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();
		$companies = Company::all();
		$chauffeur = DriverBooking::where('booking_id', $booking->id)->value('driver_id');	
        return view('layouts.editbookings', ['booking' => $booking, 
											 'companies' => $companies,
											 'chauffeur' => $chauffeur,
											 'drivers' => $drivers]);
    }
	
	public function copy2(Booking $booking, $id){
		$booking = Booking::find($id);
		$companies = Company::all();
		$drivers = Driver::all();
        return view('layouts.copybookings', ['booking' => $booking, 'companies' => $companies, 'drivers' => $drivers]);
    }
	
	public function retFlight(Booking $booking, $id)
    {
		$booking = Booking::find($id);
		$companies = Company::all();
		//$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();
        return view('layouts.addreturnbookings', ['booking' => $booking, 'companies' => $companies, 'drivers' => $drivers]);
    }
	
	public function filter(Request $request)
	{
		$yesterday = Carbon::yesterday();
        $datetoday = $yesterday->toDateString();
		//$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();
		info('request');
		info($request);
		$chauffeurId = $request->input('chauffeur');
		/*info('chauffeurId');
		info($chauffeurId);
		$chauffeur = Driver::find($chauffeurId);
		info('chauffeur');
		info($chauffeur);
		
		$selectedChauffeur = json_decode($chauffeur, true)['name'];
		info('$selectedChauffeur');
		info($selectedChauffeur);*/
		if (is_null($chauffeurId)){
			$yesterday = Carbon::yesterday();
        	$datetoday = $yesterday->toDateString();
			$bookings = Booking::select('bookings')
				->select('bookings.*', 'drivers.name as driver_name', 'bookings.pickup_date as date', 'bookings.pickup_time as time')
				->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
				->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
				->where('bookings.pickup_date', '<=', $datetoday)
				->orWhere(function ($query) use ($datetoday) { // Include 'use ($datetoday)' here
					$query->where('bookings.pickup_date', '>', $datetoday)
						->where('bookings.status', 'Completed');
				})
				->orderBy('bookings.pickup_date', 'DESC')
				->orderBy('bookings.pickup_time', 'DESC')
				->get();
			
		}
		else {
			$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
			->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
			->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
			->where('bookings.pickup_date', '<=', $datetoday)
			->where('bookings.status', '<>', 'Completed')
			->where("driver_booking.driver_id", "=", $chauffeurId )
			->orderBy('bookings.pickup_date', 'DESC')
			->orderBy('bookings.pickup_time', 'DESC')
			->get();
		}

		
		
			
			/*$bookings = Booking::leftJoin('driver_booking', function ($join) use ($chauffeurId) {
			$join->on('bookings.id', '=', 'driver_booking.booking_id');
			
				 
				 
		})
		->where('driver_booking.driver_id', '=', $chauffeurId) // OF ->orWhere('driver_booking.driver_id', '=', $chauffeurId)
		->where('bookings.status', '<>', 'Completed')
		->get(['bookings.*']);-*/
		/*$bookings = Booking::whereHas('drivers', function ($query) use ($chauffeurId) {
			$query->where('driver_id', $chauffeurId);
		})->get();*/
		//$bookings = Booking::where('booking.driver_name', $driverName)->get();
				
		return view('layouts.compbookings', compact('drivers', 'bookings'));
	}
	
	public function filterPeriod(Request $request)
	{
		$twoMonthsAgo = Carbon::now()->subMonths(2)->toDateString();
		$yesterday = Carbon::yesterday();
        $datetoday = $yesterday->toDateString();
		$chauffeurId = $request->input('chauffeur');
		$onAccount = $request->input('onaccount');
		$company = $request->input('company');
		
		$naam = $request->input('naam');
		$naam = strtolower(trim($naam));

		$adres = $request->input('adres');
		$adres = strtolower(trim($adres));
		
		$telnr = $request->input('telnr');
		$telnr = $telnr = preg_replace('/\D/', '', $telnr);
				
		//$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();
		$companies = Company::all();
					
		$from = $request->input('from');
		$till = $request->input('till');
		
		switch (true){
			case $naam && $from	:
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')	
							->where('bookings.pickup_date', '<=', $datetoday)
							->whereRaw('LOWER(bookings.name) like ?', ["%{$naam}%"]) 							
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $adres && $from	:
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')	
							->where('bookings.pickup_date', '<=', $datetoday)
							->whereRaw('LOWER(bookings.pickup_address) LIKE ?', ["%{$adres}%"])
                        	->orWhereRaw('LOWER(bookings.destination) LIKE ?', ["%{$adres}%"])					
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $telnr && $from	:
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')	
							->where('bookings.pickup_date', '<=', $datetoday)
							->whereRaw('REGEXP_REPLACE(bookings.phone, "[^0-9]", "") LIKE ?', ["%{$telnr}%"])
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name',
								'drivers.phone as driver_phone', 
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $naam :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
					->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
					->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')    
					->where('bookings.pickup_date', '>=', $twoMonthsAgo)
					->where('bookings.pickup_date', '<=', $datetoday)
					->whereRaw('LOWER(bookings.name) like ?', ["%{$naam}%"])                                                        
					->orderBy('bookings.pickup_date', 'DESC')
					->orderBy('bookings.pickup_time', 'DESC')
					->get();
		
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 												
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $adres :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')	
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)
							->whereRaw('LOWER(bookings.pickup_address) LIKE ?', ["%{$adres}%"])
                        	->orWhereRaw('LOWER(bookings.destination) LIKE ?', ["%{$adres}%"])
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;	
			case $telnr :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name',
								'drivers.phone as driver_phone', 
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')								
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)
							->whereRaw('REGEXP_REPLACE(bookings.phone, "[^0-9]", "") LIKE ?', ["%{$telnr}%"])
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break; 
			case $chauffeurId && $onAccount && $from	:
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')	
							->where('bookings.pickup_date', '<=', $datetoday)
							->where("driver_booking.driver_id", "=", $chauffeurId )
							->where("bookings.mode", "=", 'On Account' )
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name',
								'drivers.phone as driver_phone', 
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $company && $onAccount && $from	:
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '<=', $datetoday)
							->where("bookings.company", "=", $company )
							->where("bookings.mode", "=", 'On Account' )
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $chauffeurId && $from :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '<=', $datetoday)
							->where("driver_booking.driver_id", "=", $chauffeurId )			
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();	
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $company && $from :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '<=', $datetoday)					
							->where("bookings.company", "=", $company )										
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();	
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $chauffeurId && $onAccount :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)
							->where("driver_booking.driver_id", "=", $chauffeurId )
							->where("bookings.mode", "=", 'On Account' )							
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $company && $onAccount :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)					
							->where("bookings.company", "=", $company )	
							->where("bookings.mode", "=", 'On Account' )							
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name',
								'drivers.phone as driver_phone', 
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $onAccount && $from :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '<=', $datetoday)					
							->where("bookings.mode", "=", 'On Account' )
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $chauffeurId :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)
							->where("driver_booking.driver_id", "=", $chauffeurId )							
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $company :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'bookings.pickup_date as date', 
								'drivers.phone as driver_phone',
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)
							->where("bookings.company", "=", $company )							
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $onAccount :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')					
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)					
							->where("bookings.mode", "=", 'On Account' )							
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;
			case $from :
				$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '<=', $datetoday)					
							->where('bookings.pickup_date', '>=', $from )
							->where('bookings.pickup_date', '<=', $till)
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				if ($bookings->isEmpty()) {				
					echo "Geen boekingen gevonden.";
					$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
							->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
							->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
							->where('bookings.pickup_date', '>=', $twoMonthsAgo)
							->where('bookings.pickup_date', '<=', $datetoday)			
							->orderBy('bookings.pickup_date', 'DESC')
							->orderBy('bookings.pickup_time', 'DESC')
							->get();
				}
				break;	
		}
					
		return view('layouts.compbookings', compact('drivers', 'companies', 'bookings' ));
	}

	public function onaccountNew()
	{
		$yesterday = Carbon::yesterday();
        $datetoday = $yesterday->toDateString();
		//$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();
		$companies = Company::all();

		$bookings = Booking::select('bookings.*', 
                            'drivers.name as driver_name', 
							'drivers.phone as driver_phone',
                            'bookings.pickup_date as date', 
                            'bookings.pickup_time as time')
					->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
					->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
					->where('bookings.pickup_date', '>', $datetoday)
					->where('bookings.status', '<>', 'Completed')
					->where("bookings.mode", "=", 'On Account' )
					->orderBy('bookings.pickup_date', 'ASC')
					->orderBy('bookings.pickup_time', 'ASC')
					->get();
							
	
		return view('layouts.bookings', compact('drivers', 'companies', 'bookings'));
	}

	
	public function onaccountCompleted()
	{
		$yesterday = Carbon::yesterday();
        $datetoday = $yesterday->toDateString();
		$drivers = Driver::all();
				
		$bookings = Booking::select('bookings.*', 
								'drivers.name as driver_name', 
								'drivers.phone as driver_phone',
								'bookings.pickup_date as date', 
								'bookings.pickup_time as time')
			->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
			->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')
			->where('bookings.pickup_date', '<=', $datetoday)
			->where('bookings.status', '<>', 'Completed')
			->where("bookings.mode", "=", 'On Account' )
			->orderBy('bookings.pickup_date', 'DESC')
			->orderBy('bookings.pickup_time', 'DESC')
			->get();						
				
		return view('layouts.compbookings', compact('drivers', 'bookings'));
	}

	

    public function update(Request $request)
    {
        $booking = Booking::findOrFail($request->id);

        // Update the fields with new values from the request
        $booking->name = $request->input('uname');
        $booking->email = $request->input('email');
        $booking->phone = $request->input('mobile');
		$booking->company = $request->input('company');
        $booking->remark = $request->input('remark');
        $booking->press = $request->input('from1');
        $booking->house_no_from = $request->input('house_no_from');
        $booking->destination = $request->input('to');
        $booking->house_no_to = $request->input('house_no_to');
        $booking->price = $request->input('price');
        $booking->price1 = $request->input('price1');
        $booking->mode = $request->input('mode');
        $booking->km = $request->input('km');
        $booking->min = $request->input('min');
        $booking->customer = $request->input('customer');
      
        $booking->pickup_address = $request->input('pickup_address');
        $booking->pickup_date = $request->input('pickup_date');
        $booking->pickup_time = $request->input('pickup_time');
        $booking->return_flight = $request->input('return');
        $booking->time_return_flight = $request->input('flight_time');
        $booking->date_return_flight = $request->input('flight_date');
        $booking->press = $request->input('press');
        $booking->luggage = $request->input('luggage');
        $booking->vehicle = $request->input('vehicle');
		
		//driver ingevuld, nnieuw of update
	/*	if ($request->input('driver_id') !== null){	
			$driverBooking = DriverBooking::where('booking_id', $request->id)->first();
			if ($driverBooking) {
				$driverBooking->driver_id = (int) $request->driver_id;
				$driverBooking->save();
			}
			else {
				$driverBooking = DriverBooking::create([
					'driver_id' => (int) $request->driver_id,
					'booking_id' => $booking->id,
					'status' => 'Pending'
				]);
				
				if ($driverBooking) {
					$booking->assign_id = $driverBooking->id;
					$booking->status = 'Assigned';
				}
			}			
		} */
		
		if ($request->filled('driver_id')) {

			DB::transaction(function () use ($request, $booking) {

				// Zoek of er al een driver_booking voor deze booking bestaat
				$driverBooking = DriverBooking::where('booking_id', $booking->id)->first();

				if ($driverBooking) {
					// Alleen de driver_id aanpassen
					$driverBooking->driver_id = (int) $request->driver_id;
					$driverBooking->save();

				} else {
					// Nieuwe driver_booking aanmaken
					$driverBooking = DriverBooking::create([
						'driver_id' => (int) $request->driver_id,
						'booking_id' => $booking->id,
						'status' => 'Pending'
					]);

					// Koppeling naar booking pas zetten bij nieuwe aanmaak
					$booking->assign_id = $driverBooking->id;
					$booking->status = 'Assigned';
					$booking->save();
				}

				// Door de transactie hoef je niet te wachten of create klaar is:
				// alles commit pas samen, dus dit is 100% veilig.
			});
		}
        	
        		
        // Save the updated booking
        $booking->save();

        Session::flash('success', 'Booking Updated successfully!');

        return redirect()->route('bookings.index');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        Session::flash('success', 'Deleted successfully!');
        return redirect()->route('bookings.index');
    }


    public function completedBookings()
    {
		$twoMonthsAgo = Carbon::now()->subMonths(2)->toDateString();
        $yesterday = Carbon::yesterday();
        $datetoday = $yesterday->toDateString();
		$bookings = Booking::select('bookings')
			->select('bookings.*', 
					 'drivers.name as driver_name',
					 'drivers.phone as driver_phone',  
					 'bookings.pickup_date as date', 
					 'bookings.pickup_time as time')
			->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
			->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')						
			->where('bookings.pickup_date', '>=', $twoMonthsAgo)
			->where('bookings.pickup_date', '<=', $datetoday)
			->orWhere(function ($query) use ($datetoday) { // Include 'use ($datetoday)' here
				$query->where('bookings.pickup_date', '>', $datetoday)
					->where('bookings.status', 'Completed');
			})
			->orderBy('bookings.pickup_date', 'DESC')
			->orderBy('bookings.pickup_time', 'DESC')
			->get();
        //$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();
		$companies = Company::all();
        return view('layouts.compbookings', ['bookings' => $bookings, 'drivers' => $drivers, 'companies' => $companies]);
    }

    function bookingStatus(Request $request){
       

        if (isset($request->booking_id)) {
            // Retrieve the booking and update its status and driver_id
            $booking = Booking::findOrFail($request->booking_id);
            $booking->status = 'Completed';
            $booking->save();
            // Session::flash('success', 'Booking Completed Succssfully');
			return response()->json(['success' => 'Booking Completed Succssfully'], 200);
        } else {
            // Session::flash('success', 'Failed to Complete the Booking');
			return response()->json(['failed' => 'Failed to Complete the Booking'], 200);
            
        }


    }
	
	public function showUserReceipt($id)
    {
		$prices = Prices_per_city::all();
		
        $booking = Booking::select('bookings.*',                             
                            'bookings.pickup_date as date', 
                            'bookings.pickup_time as time')
        ->where('bookings.id', '=', $id)       
        ->first();
        return view('frontend.userreceipt', compact('booking'));
    }
	
	public function userReceiptMail($request)
    {
        $booking->name = $request->input('name');
		$booking->pickup_address = $request->input('pickup_address');
		$booking->destination = $request->input('destination');
		$booking->press = $request->input('press');
		$booking->pickup_date = $request->input('pickup_date');
		$booking->pickup_time = $request->input('pickup_time');
		$booking->price1 = $request_input('price1');
		
		try {
		Mail::send('layouts.userreceiptemail', ['booking' => $booking], function($message) use ($request) {
			$message->to($request->input('email'))
				    ->cc('info@spl.taxi')
					->attachData($docxContent, 'receipt.docx', [
                    	'mime' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                	])
					->subject('Booking receipt');
		});

		return redirect('/admin/bookings')
        ->with('success', 'Booking receipt is verzonden!');  //redirect naar url /admin/bookings
		}catch (\Exception $e) {
        // Log het probleem
        Log::error('❌ Mailfout: ' . $e->getMessage());

        // Geef fout terug in het scherm (alleen in ontwikkelomgeving!)
        return response()->json([
            'status' => '❌ Mail NIET verzonden',
            'foutmelding' => $e->getMessage()
        ], 500);
    }
		
     
    }
	
	public function showCompanies()
    {
        $companies = Company::all();

        return view('layouts.companies', ['companies' => $companies]);
    }
	
	public function invoice()
    {
        //$drivers = Driver::all();
		$drivers = Driver::orderBy('order', 'asc')->get();

        return view('layouts.makeinvoice', ['drivers' => $drivers]);
    }
	
	public function createInvoiceCompany()
    {
		$companies = Company::all();

        return view('layouts.createInvoiceCompany', ['companies' => $companies]);
    }
	
	public function createInvoiceClient()
    {
		$clients = Booking::distinct()->orderBy('name', 'asc')->pluck('name');

        return view('layouts.createInvoiceClient', ['clients' => $clients]);
    }
	
	public function showInvoice(Request $request)
    { 
		// variabelen 
        $driver = $request['driver_id'];
		// year en moth zijn integers
        $year = (int) $request['year'];
        $month = (int) $request['month'];
		
		$monthName = $this->monthName($month);
		
		// query om de gegevens van de factuur op te halen
		$invoice = Booking::select(
				'bookings.id',
				'bookings.assign_id',
				'drivers.id as driver_id',
				'drivers.name as driver_name',
				'bookings.pickup_date as date', 
				'bookings.pickup_time as time',
				'bookings.pickup_address as from',
				'bookings.destination as to',
				'bookings.price', 
				'bookings.price1',			
				\DB::raw("$year AS year"),
				\DB::raw("$month AS month"), 
				\DB::raw("'$monthName' AS monthName"),
				\DB::raw("CAST((
					CASE
						WHEN bookings.mode = 'On account' THEN 0.00
						WHEN TRIM(bookings.price1) = 'Code €' THEN 0.00  -- Als het exact gelijk is aan 'Code €', geef 0.00 terug
						WHEN TRIM(bookings.price1) = '10%' THEN 
							CAST(SUBSTRING(bookings.price1, 1, LENGTH(bookings.price1) - 1) AS DECIMAL(10,2)) * 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) / 100
						WHEN bookings.price1 = '' THEN 0.00
						WHEN TRIM(bookings.price1) LIKE  '€%' THEN CAST(NULLIF(REPLACE(REPLACE(bookings.price1, '', ''), ',', '.'), '') AS DECIMAL(10,2))
						ELSE  -- Anders, voer standaard verwerking uit voor andere gevallen
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, 'Code €', ''), ',', '.'), '') AS DECIMAL(10,2))
					END) AS DECIMAL(10,2)) AS commissie")  ,
				\DB::raw("SUM(
					COALESCE(
						CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)), 0)
					) OVER (PARTITION BY drivers.name) AS totaal") , 
				\DB::raw("SUM(CAST((
					CASE
						WHEN TRIM(bookings.price1) = 'Code €' THEN 0.00
						WHEN TRIM(bookings.price1) = '10%' THEN 
							CAST(SUBSTRING(bookings.price1, 1, LENGTH(bookings.price1) - 1) AS DECIMAL(10,2)) * 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) / 100
						WHEN bookings.price1 = '' THEN 0.00
						WHEN TRIM(bookings.price1) LIKE '€%' THEN 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, '€', ''), ',', '.'), '') AS DECIMAL(10,2))
						ELSE 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, 'Code €', ''), ',', '.'), '') AS DECIMAL(10,2))
					END) AS DECIMAL(10,2))) OVER (PARTITION BY drivers.name) AS totaal_commissie" )
				)
			->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
			->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')    
			->where('drivers.id', '=', $driver)
			->whereRaw('YEAR(bookings.pickup_date) = ?', [$year])
			->whereRaw('MONTH(bookings.pickup_date) = ?', [$month])
			->orderBy('bookings.pickup_date', 'DESC')
			->orderBy('bookings.pickup_time', 'DESC')
			->get();
		// Verwijder het euroteken 
		$invoice->transform(function ($item) {
   			$item->price = str_replace('€', '', $item->price);  
			$item->commissie = str_replace('€', '', $item->commissie); 
	    	return $item;
		});
		
		if ($invoice->isEmpty()){
			 $driver = Driver::find($driver); // Haal de driver op met de ID
    
			$invoice = [
				(object)[
					'driver_name' => $driver->name,
					'year' => $year,
					'monthName' => $monthName,
					'from' => 'nvt'
				]
			];
		}
		
        return view('layouts.invoice', ['invoice' => $invoice]);
    }

	public function invoiceCompany(Request $request)
    { 
		// variabelen 
        $company = $request['company'];
		// year en moth zijn integers
        $year = (int) $request['year'];
        $month = (int) $request['month'];
		
		$monthName = $this->monthName($month);
		
		// query om de gegevens van de factuur op te halen
		$invoice = Booking::select(
				'bookings.id',
				'bookings.assign_id',
				'company as company',
				'bookings.pickup_date as date', 
				'bookings.pickup_time as time',
				'bookings.pickup_address as from',
				'bookings.destination as to',
				'bookings.price', 
				'bookings.price1',			
				\DB::raw("$year AS year"),
				\DB::raw("$month AS month"), 
				\DB::raw("'$monthName' AS monthName"),
				\DB::raw("CAST((
					CASE
						WHEN bookings.mode = 'On account' THEN 0.00
						WHEN TRIM(bookings.price1) = 'Code €' THEN 0.00  -- Als het exact gelijk is aan 'Code €', geef 0.00 terug
						WHEN TRIM(bookings.price1) = '10%' THEN 
							CAST(SUBSTRING(bookings.price1, 1, LENGTH(bookings.price1) - 1) AS DECIMAL(10,2)) * 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) / 100
						WHEN bookings.price1 = '' THEN 0.00
						WHEN TRIM(bookings.price1) LIKE  '€%' THEN CAST(NULLIF(REPLACE(REPLACE(bookings.price1, '', ''), ',', '.'), '') AS DECIMAL(10,2))
						ELSE  -- Anders, voer standaard verwerking uit voor andere gevallen
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, 'Code €', ''), ',', '.'), '') AS DECIMAL(10,2))
					END) AS DECIMAL(10,2)) AS commissie")  ,
				\DB::raw("SUM(
					COALESCE(
						CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)), 0)
					) OVER (PARTITION BY bookings.company) AS totaal") , 
				\DB::raw("SUM(CAST((
					CASE
						WHEN TRIM(bookings.price1) = 'Code €' THEN 0.00
						WHEN TRIM(bookings.price1) = '10%' THEN 
							CAST(SUBSTRING(bookings.price1, 1, LENGTH(bookings.price1) - 1) AS DECIMAL(10,2)) * 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) / 100
						WHEN bookings.price1 = '' THEN 0.00
						WHEN TRIM(bookings.price1) LIKE '€%' THEN 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, '€', ''), ',', '.'), '') AS DECIMAL(10,2))
						ELSE 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, 'Code €', ''), ',', '.'), '') AS DECIMAL(10,2))
					END) AS DECIMAL(10,2))) OVER (PARTITION BY bookings.company) AS totaal_commissie" )
				)			
			->where('bookings.company', '=', $company)
			->whereRaw('YEAR(bookings.pickup_date) = ?', [$year])
			->whereRaw('MONTH(bookings.pickup_date) = ?', [$month])
			->orderBy('bookings.pickup_date', 'DESC')
			->orderBy('bookings.pickup_time', 'DESC')
			->get();
		// Verwijder het euroteken 
		$invoice->transform(function ($item) {
   			$item->price = str_replace('€', '', $item->price);  
			$item->commissie = str_replace('€', '', $item->commissie); 
	    	return $item;
		});
		
		if ($invoice->isEmpty()){
			$invoice = [
				(object)[
					'company' => $company,
					'year' => $year,
					'monthName' => $monthName,
					'from' => 'nvt'
				]
			];
		}
		
        return view('layouts.invoiceCompany', ['invoice' => $invoice]);
    }
	public function invoiceClient(Request $request)
    { 
		// variabelen 
        $client = $request['client'];
		// year en moth zijn integers
        $year = (int) $request['year'];
        $month = (int) $request['month'];
		
		$monthName = $this->monthName($month);
		
		// query om de gegevens van de factuur op te halen
		$invoice = Booking::select(
				'bookings.id',
				'bookings.assign_id',
				'bookings.name as client',
				'bookings.pickup_date as date', 
				'bookings.pickup_time as time',
				'bookings.pickup_address as from',
				'bookings.destination as to',
				'bookings.price', 
				'bookings.price1',			
				\DB::raw("$year AS year"),
				\DB::raw("$month AS month"), 
				\DB::raw("'$monthName' AS monthName"),
				\DB::raw("CAST((
					CASE
						WHEN bookings.mode = 'On account' THEN 0.00
						WHEN TRIM(bookings.price1) = 'Code €' THEN 0.00  -- Als het exact gelijk is aan 'Code €', geef 0.00 terug
						WHEN TRIM(bookings.price1) = '10%' THEN 
							CAST(SUBSTRING(bookings.price1, 1, LENGTH(bookings.price1) - 1) AS DECIMAL(10,2)) * 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) / 100
						WHEN bookings.price1 = '' THEN 0.00
						WHEN TRIM(bookings.price1) LIKE  '€%' THEN CAST(NULLIF(REPLACE(REPLACE(bookings.price1, '', ''), ',', '.'), '') AS DECIMAL(10,2))
						ELSE  -- Anders, voer standaard verwerking uit voor andere gevallen
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, 'Code €', ''), ',', '.'), '') AS DECIMAL(10,2))
					END) AS DECIMAL(10,2)) AS commissie")  ,
				\DB::raw("SUM(
					COALESCE(
						CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)), 0)
					) OVER (PARTITION BY bookings.company) AS totaal") , 
				\DB::raw("SUM(CAST((
					CASE
						WHEN TRIM(bookings.price1) = 'Code €' THEN 0.00
						WHEN TRIM(bookings.price1) = '10%' THEN 
							CAST(SUBSTRING(bookings.price1, 1, LENGTH(bookings.price1) - 1) AS DECIMAL(10,2)) * 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) / 100
						WHEN bookings.price1 = '' THEN 0.00
						WHEN TRIM(bookings.price1) LIKE '€%' THEN 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, '€', ''), ',', '.'), '') AS DECIMAL(10,2))
						ELSE 
							CAST(NULLIF(REPLACE(REPLACE(bookings.price1, 'Code €', ''), ',', '.'), '') AS DECIMAL(10,2))
					END) AS DECIMAL(10,2))) OVER (PARTITION BY bookings.company) AS totaal_commissie" )
				)			
			->where('bookings.name', '=', $client)
			->whereRaw('YEAR(bookings.pickup_date) = ?', [$year])
			->whereRaw('MONTH(bookings.pickup_date) = ?', [$month])
			->orderBy('bookings.pickup_date', 'DESC')
			->orderBy('bookings.pickup_time', 'DESC')
			->get();
		// Verwijder het euroteken 
		$invoice->transform(function ($item) {
   			$item->price = str_replace('€', '', $item->price);  
			$item->commissie = str_replace('€', '', $item->commissie); 
	    	return $item;
		});
		
		if ($invoice->isEmpty()){
			$invoice = [
				(object)[
					'client' => $client,
					'year' => $year,
					'monthName' => $monthName,
					'from' => 'nvt'
				]
			];
		}
				
        return view('layouts.invoiceClient', ['invoice' => $invoice]);
    }
	
	public function editInvoice($id, Request $request)
    {
		// haal de gegevens op van de boeking die gewijzigd wordt
		$invoice = Booking::select(
						'bookings.id',
						'bookings.assign_id',
						'drivers.id as driver_id',
						'drivers.name as driver_name',
						'bookings.pickup_date as date', 
						'bookings.pickup_time as time',
						'bookings.pickup_address as from',
						'bookings.destination as to',
						\DB::raw("CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) AS price"),  
						\DB::raw("CAST((
								CASE
									WHEN bookings.mode = 'On account' THEN 0.00
									WHEN TRIM(bookings.price1) = 'Code €' THEN 0.00  -- Als het exact gelijk is aan 'Code €', geef 0.00 terug
									WHEN TRIM(bookings.price1) = '10%' THEN 
										CAST(SUBSTRING(bookings.price1, 1, LENGTH(bookings.price1) - 1) AS DECIMAL(10,2)) * 
										CAST(NULLIF(REPLACE(REPLACE(bookings.price, '€', ''), ',', '.'), '') AS DECIMAL(10,2)) / 100
									WHEN bookings.price1 = '' THEN 0.00
									WHEN TRIM(bookings.price1) LIKE  '€%' THEN CAST(NULLIF(REPLACE(REPLACE(bookings.price1, '', ''), ',', '.'), '') AS DECIMAL(10,2))
									ELSE  -- Anders, voer standaard verwerking uit voor andere gevallen
										CAST(NULLIF(REPLACE(REPLACE(bookings.price1, 'Code €', ''), ',', '.'), '') AS DECIMAL(10,2))
								END) AS DECIMAL(10,2)) AS commissie")						
						)
					->leftJoin('driver_booking', 'driver_booking.id', '=', 'bookings.assign_id')
					->leftJoin('drivers', 'driver_booking.driver_id', '=', 'drivers.id')    
					->where('bookings.id', '=', $id)
					->firstorFail();
		
		// vul de extra gegvens van de factuur 
		$invoice->year = $request->year;
		$invoice->month = $request->month;
		$invoice->monthName= $request->monthNamer;
		$invoice->totaal = $request->totaal;
		$invoice->totaal_commissie = $request->totaal_commissie;
		
		return view('layouts.editinvoice', ['invoice' => $invoice]);
    }
	
	public function updateInvoice(Request $request)
    {		
		// ook de booking die geupdate wordt
		$booking = Booking::find($request->id);
		
        // Update de velden
		$booking->price = (float) $request->price;
		$booking->price1 = (float) $request->commissie;
		
		//save de booking
		$booking->save();	
		
		// Maak een nieuw Request-object aan met de data als parameters om de factuur met nieuwe gegevens te zien
		$invoiceRequest = Request::create('/', 'POST', [
			'driver_id' => $request->driverId,
			'year'       => $request->year,
			'month'      => $request->month,
		]);
		
		return $this->showInvoice($invoiceRequest);
    }
	
	public function createCompany()
    {
		 return view('admin.addcompanies');
    }
	
    public function editCompany($id)
    {
		$company = Company::find($id);
		
		return view('layouts.editcompanies', ['company' => $company]);
    }

    public function storeCompany(Request $request)
    {        
        $company = new Company();
        $company->naam = $request['name'];
        $company->save();
        return redirect()->route('admin.companies');
    }
	
    public function updateCompany(Request $request)
    {

        //dd($request);
        $data = Company::where('id', $request->id)->update([
            'naam' => $request->name
        ]);

        Session::flash('success', 'Data Updated successfully!');

        return redirect()->route('admin.companies');
    }
	
	public function editWhatsapp($id)
    {
		$booking = Booking::find($id);
		$drivers = Driver::orderBy('order', 'asc')->get();
		$companies = Company::all();
		$chauffeur = DriverBooking::where('booking_id', $booking->id)->value('driver_id');
		
		$driver = Driver::find($chauffeur);
		$pickupDate = \Carbon\Carbon::parse($booking->pickup_date);
		$message =  "Hallo " . $driver->name . "," . "\n\nDeze rit is aan jou toegewezen: " .
					"\n\n*Datum:* " . $pickupDate->format('D') . " " . $pickupDate->format('d-m-Y') .
					"\n*Tijd:* " . $booking->pickup_time .
					"\n*Van:* " . ($booking->pickup_address ?? '') .
					"\n*Huisnummer:* " . ($booking->house_no_from ?? '') .
					"\n*Naar:* " . ($booking->destination ?? '') .
					"\n*Huisnummer:* " . ($booking->house_no_to ?? '') .
					"\n*Naam:* " . $booking->name .
					"\n*Telefoon:* " . $booking->phone .
					"\n*Bedrijf:* " . $booking->company .
					"\n*Prijs:* " . $booking->price .
					"\n*Code:* " . $booking->price1 .
					"\n*Mode:* " . $booking->mode .
					"\n*Pax:* " . $booking->press .
					"\n*Bagage:* " . $booking->luggage .
					"\n*Voertuig:* " . ($booking->vehicle ?? '') .
					"\n*Opmerkingen:* " . $booking->remark;

		$phone = '31' . ltrim($driver->phone, '0');	
		$displayMessage = str_replace("\n", "\r\n", $message); // voor nette weergave in textare
		
        return view('layouts.editwhatsapp', ['phone' => $phone, 
											 'displayMessage' => $displayMessage]);
    }
	
	public function sendWhatsapp($request){
		
	}
	
	public function sendWhatsAppMessage($to, $message) {
		$sid = 'ACbb8b505c6424e52c0462c3cc1ce1355a';
		$token = 'bfe6e71ba41a016115b8246b02916c3b';
		$client = new Client($sid, $token);

		$client->messages->create(
			'whatsapp:' . $to,
			[
				'from' => 'whatsapp:+14155238886', // Twilio WhatsApp Sandbox Number
				'body' => $message
			]
    	);
	}
		
	private function monthName($month){
		// monthName vullen nmet de naam an de maand
		switch($month) {
			case 1:
				$monthName = "Januari";
				break;
			case 2:
				$monthName = "Februari";
				break;
			case 3:
				$monthName = "Maat";
				break;
			case 4:
				$monthName = "April";
				break;
			case 5:
				$monthName = "Mei";
				break;
			case 6:
				$monthName = "Juni";
				break;
			case 7:
				$monthName = "Juli";
				break;
			case 8:
				$monthName = "Augustus";
				break;
			case 9:
				$monthName = "September";
				break;
			case 10:
				$monthName = "Oktober";
				break;
			case 11:
				$monthName = "November";
				break;
			case 12:
				$monthName = "December";
				break;
		}
		
		return $monthName;
	}

	public function whatsappVerify(Request $request)
    {
        $verifyToken = "9qEtOSeKeAlkeDx5qO9O"; // kies iets unieks

        $mode = $request->get('hub_mode');
        $token = $request->get('hub_verify_token');
        $challenge = $request->get('hub_challenge');

        if ($mode === 'subscribe' && $token === $verifyToken) {
            return response($challenge, 200);
        }

        return response('Invalid token', 403);
    }

    // Webhook berichten ontvangen
    public function whatsappReceive(Request $request)
    {
		$data = $request->all();
	
		if (isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {
			$message = $data['entry'][0]['changes'][0]['value']['messages'][0];

			WhatsappMessage::create([
					'wa_id'        => $message['id'],
					'from_number'  => $message['from'],
					'message_text' => $message['text']['body'] ?? '',
					'received_at'  => now(),
			]);
		} 
        // Ontleed hier het bericht en sla op in database
        //\Log::info($request->all()); // tijdelijk om te testen
        return response('Received', 200);
		//return response()->json($request->all());
    }
	
	public function fetchOutlookMails()
    {

		$hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
		$username = 'spltaximail@gmail.com';
		$password = 'adcffkkyzothshbz'; // of een app-wachtwoord*/
		$context = stream_context_create([
			'ssl' => [
				'verify_peer' => false,
				'verify_peer_name' => false,
				'SNI_enabled' => true,
				'peer_name' => 'imap.gmail.com'
			]
		]);

		//$inbox = @imap_open('{imap.gmail.com:993/imap/ssl}INBOX', $username, $password, 0, 1, ['context' => $context]);
		$inbox = @imap_open($hostname, $username, $password) or die('Kan niet verbinden: ' . imap_last_error());
		if (!$inbox) {
			echo "Foutmelding: " . imap_last_error();
		} else {
			echo "Verbinding geslaagd! ";

		}

		$emails = imap_search($inbox, 'UNSEEN'); // Ongelezen e-mails
		$emailsData = [];
		if ($emails) {
			rsort($emails); // Nieuwste eerst
			foreach ($emails as $email_number) {
				$overview = imap_fetch_overview($inbox, $email_number, 0);
				$body = $this->getEmailBody($inbox, $email_number);

		//        $body = imap_fetchbody($inbox, $email_number, 1);

				$parsed = $this->parseTaxiMail($body ?? '');

				$emailData = [
					'from' 					=> $overview[0]->from ?? '',
					'subject' 				=> $overview[0]->subject ?? '(geen onderwerp)',
					'body' 					=> $body ?? '(geen inhoud)',
					'received_at'  			=> now(),
					'pickup_date' 			=> $parsed['datum'],
					'pickup_time' 			=> $parsed['tijd'],
					'pickup_address' 		=> $parsed['van'],
					'destination' 			=> $parsed['naar'],			
					'to' 					=> $parsed['naar'],
					'press' 				=> $parsed['personen'],
					'uname'   				=> $parsed['naam'],
					'vehicle' 				=> $parsed['vehicle'],
					'mode'  				=> $parsed['betaalwijze'],
					'mobile'  				=> $parsed['mobiel'],
					'flight_no'  			=> $parsed['vluchtnummer'],
					'remark'  				=> $parsed['opmerking'],
					'price'  				=> $parsed['price'],
					'price1'  				=> $parsed['price1'],
					'house_no_from'  		=> $parsed['house_no_from'],
					'house_no_to'  			=> $parsed['house_no_to'],
					'company'  				=> $parsed['company'],
					'km'     				=> null,
					'min'    				=> null,
					'email'  				=> $parsed['email'],
					'luggage' 				=> $parsed['luggage'],
					'return' 				=> $parsed['return'],
					'flight_date'			=> $parsed['flight_date'],
					'flight_time'			=> $parsed['flight_time'],
					'flight_no_on_return' 	=> $parsed['flight_no_on_return']
				];
				
				$whatsappData = Arr::except($emailData, ['to', 'return']);
				WhatsappMessage::create($whatsappData);	

				$bookingMail = Arr::except($emailData, ['from', 'subject', 'body', 'received_at', 'destination']);

				// maak een request object// maak een request object
				$request = new Request($bookingMail);

				// roep de adminStore functie aan
				$this->adminStore($request);

			}
		}
		
        imap_close($inbox); 
		
		echo 'Email verwerkt!';
        return;
    }
	
	private function parseTaxiMail(string $text)
	{
		$result = [
			"datum"        			=> null, // let op: geen default vandaag (vermijdt foute datum)
			"tijd"         			=> null,
			"van"          			=> null,
			"naar"         			=> null,
			"personen"     			=> null,
			"naam"         			=> null,
			"mobiel"       			=> null,
			"vluchtnummer" 			=> null,
			"opmerking"    			=> null,
			"betaalwijze"  			=> null,
			"vehicle"      			=> null,
			"price"        			=> null,
			"price1"       			=> null,
			"house_no_from"			=> null,
			"house_no_to"  			=> null,
			"luggage"      			=> null,
			"email"        			=> null,
			"return"	   			=> null,
			"flight_date"  			=> null,
			"flight_time"  			=> null,
			"flight_no_on_return" 	=> null,
			"company"				=> null
		];

		// split regels netjes (houd originele regels voor adresparsing)
		$lines = preg_split('/\r\n|\r|\n/', $text);
		$lines = array_map('trim', $lines);
		// rommel-voetnoten verwijderen (case-insensitive)
		$lines = array_filter($lines, fn($l) => !preg_match('/verstuurd vanaf mijn\s*iphone/i', $l));
		$lines = array_filter($lines, fn($l) => $l !== '');
		
		$fullText = trim(preg_replace('/\s+/', ' ', $text)); // samengeknepen versie voor fallback checks
		// rommel-voetnoten verwijderen (case-insensitive)
		$fullText = preg_replace('/verstuurd vanaf mijn\s*iphone/i', '', $fullText);

		// --- Mobiel flexibel herkennen (ook met spaties) ---
		if (preg_match('/(\+31\s?6(?:\s?\d){8}|06(?:\s?\d){8})/', $fullText, $m)) {
			 $mobiel = preg_replace('/[^\d+]/', '', $m[1]);  
    
			// zorgen dat alleen een '+' aan het begin mag staan
			if (strpos($mobiel, '+') > 0) {
				$mobiel = str_replace('+', '', $mobiel); 
			}
			
			$result['mobiel'] = $mobiel;
			// mobil nummer verwijderen uit de volledige tekst
			$fullText = str_replace($m[0], '', $fullText);
		}

		// --- E-mail eruit halen (voor fallback/naam) ---
		if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $fullText, $m)) {
			$result['email'] = $m[0];
			$fullText = str_replace($m[0], '', $fullText);
		}

		// --- Luggage ---
		if (preg_match_all('/((\d+)\s*)?(koffers|koffer|bags|bag|handbagage)/i', $fullText, $matches, PREG_SET_ORDER)) {
			$bags = [];
			foreach ($matches as $m) {
				$bags[] = trim(($m[2] ?? '') . ' ' . $m[3]);
				// eventueel ook uit de tekst weghalen:
				$fullText = str_replace($m[0], '', $fullText);
			}
			$result['luggage'] = implode(', ', $bags);
		}

		// Loop per regel en pak herkenbare labels / oude Rit: stijl
		foreach ($lines as $line) {
			$lineNorm = preg_replace('/\s+/', ' ', trim($line));

			// 1) Rit: dd-mm-yyyy (of dd/mm/yyyy of dd.mm.yyyy) [optioneel tijd]
			if (preg_match('/Rit:\s*(\d{2}-\d{2}-\d{4})\s*(\d{2}[.:]\d{2})?.*:\s*(.+?)\s*\/\s*(.+)/i', $line, $m)) {
				$result['datum'] = date("Y-m-d", strtotime(str_replace('-', '/', $m[1])));
				if (isset($m[2])) $result['tijd'] = str_replace('.', ':', $m[2]);		

				$result['van'] = trim($m[3]);
				$result['naar'] = trim($m[4]);
				continue;
			}

			elseif (preg_match('/\bRit:\s*([0-3]?\d[-\/\.][0-1]?\d[-\/\.]\d{4})(?:\s*(?:om)?\s*([0-2]?\d[:.]\d{2}))?/i', $lineNorm, $m)) {
				$dateRaw = str_replace(['/', '.'], '-', $m[1]); // normaliseer separators naar '-'
				// probeer d-m-Y strikt te parsen
				$dt = \DateTime::createFromFormat('d-m-Y', $dateRaw);
				if ($dt !== false) {
					$result['datum'] = $dt->format('Y-m-d');
				} else {
					// fallback: probeer strtotime (maar alleen als createFromFormat faalt)
					$ts = strtotime($m[1]);
					if ($ts !== false) {
						$result['datum'] = date('Y-m-d', $ts);
					}
				}
				if (!empty($m[2])) {
					$result['tijd'] = str_replace('.', ':', $m[2]);
				}
				continue; // verder met volgende regel
			}
			elseif (preg_match('/^([0-2]?\d[:.]\d{2})\s+(.+?)\s*\/\s*(.+)$/i', $lineNorm, $m)) {
				$result['tijd'] = str_replace('.', ':', $m[1]);
				$result['van'] = trim($m[2]);
				$result['naar'] = trim($m[3]);

				[$result['van'], $result['house_no_from']] = $this->splitAddress($result['van']);
				[$result['naar'], $result['house_no_to']] = $this->splitAddress($result['naar']);

				$result['datum'] = date('Y-m-d'); // fallback naar vandaag
				continue;
			}

			// 1b) inline Van: ... Naar: ... in dezelfde regel
			if (preg_match('/Van\s*:\s*(.*?)\s+Naar\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$result['van'] = trim($m[1]);
				$result['naar'] = trim($m[2]);
				continue;
			}

			// 2) Van: label
			if (preg_match('/^\s*Van:\s*(.+)$/i', $lineNorm, $m)) {
				$result['van'] = trim($m[1]);
				continue;
			}

			// 3) Naar: label
			if (preg_match('/^\s*Naar\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$result['naar'] = trim($m[1]);
				continue;
			}
			
			// Personen (met label Personen:)
			if (preg_match('/^Personen\s*:\s*(\d+)/i', $lineNorm, $m)) {
				$result['personen'] = "Pax " . (int)$m[1];
				continue;
			}
			
			// 4) Personen (regel)
			if (preg_match('/^Aantal personen\s*:\s*(\d+)/i', $lineNorm, $m)) {
				$result['personen'] = "Pax ".(int)$m[1];
				continue;
			}
			if (preg_match('/^(\d+)\s*pers\b/i', $lineNorm, $m)) {
				$result['personen'] = "Pax ".(int)$m[1];
				// don't continue — we might still want prijs etc in same line
			}

			// 5) Vehicle (Bus max)
			if (preg_match('/Bus\s*max\s*(\d+)/i', $lineNorm, $m)) {
				$result['vehicle'] = "Bus ".(int)$m[1];
			}

			// 6) Betaalwijze in lijn
			if (preg_match('/\b(cash|contant|pin|on account|credit card|remittance|no payment)\b/i', $lineNorm, $m)) {
				switch (strtolower($m[1])){
					case 'cash': case 'contant': $result['betaalwijze']='cash'; break;
					case 'pin': $result['betaalwijze']='pin payment'; break;
					case 'on account': $result['betaalwijze']='on account'; break;
					case 'credit card': $result['betaalwijze']='credit card'; break;
					case 'remittance': $result['betaalwijze']='remittance'; break;
					case 'online': $result['betaalwijze']='remittance'; break;
					case 'no payment': $result['betaalwijze']='no payment'; break;
				}
			}

			// 7) Prijzen in die regel (eerste = price, tweede = price1)
			if (preg_match_all('/€\s*(\d+[.,]?\d*)|(\d+[.,]?\d*)\s*(€|euro)/i', $lineNorm, $matches)) {
				$allPrices = [];
				foreach ($matches[1] as $i => $v) {
					if ($v !== '') $allPrices[] = $v;
					elseif (!empty($matches[2][$i])) $allPrices[] = $matches[2][$i];
				}
				if (isset($allPrices[0]) && !$result['price']) $result['price'] = "€ ". $allPrices[0];
				if (isset($allPrices[1]) && !$result['price1']) $result['price1'] = "Code € ". $allPrices[1];
			}

			// 8) code X (geheel tekst)
			if (!$result['price1'] && preg_match('/\bcode[\s\p{Zs}]*€?[\s\p{Zs}]*(\d+[.,]?\d*)/iu', $lineNorm, $m)) {
				$result['price1'] = "Code € ". $m[1];
			}
			
			//  Datum: label
		/*	if (preg_match('/^Datum\s*:\s*(\d{2}[-\/\.]\d{2}[-\/\.]\d{4})$/i', $lineNorm, $m)) {
				$dateRaw = str_replace(['/', '.'], '-', $m[1]);
				$dt = \DateTime::createFromFormat('d-m-Y', $dateRaw);
				if ($dt !== false) {
					$result['datum'] = $dt->format('Y-m-d');
				}
				continue;
			} */
			
		/*	if (preg_match('/^Datum\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$dateRaw = trim($m[1]);
				$ts = strtotime($dateRaw);
				if ($ts !== false) {
					$result['datum'] = date('Y-m-d', $ts);
				}
				continue;
			} */
			
			// algemene maandnaam pattern (voor gebruik in fallback checks)
			$monthPattern = 'januari|februari|maart|april|mei|juni|juli|augustus|september|oktober|november|december';

			// --- Datum: label (nu flexibel voor "3 oktober 2025" of "03-10-2025")
			if (preg_match('/^Datum\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$d = $this->parseDateToYmd($m[1]);
				if ($d) $result['datum'] = $d;
				continue;
			}



			//  Tijd: label
			if (preg_match('/^Tijd\s*:\s*([0-2]?\d[:.]\d{2})$/i', $lineNorm, $m)) {
				$result['tijd'] = str_replace('.', ':', $m[1]);
				continue;
			}

			// 9) Naam passagier (label)
			if (preg_match('/^Naam\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$naam = preg_replace('/(\+31\s?6(?:\s?\d){8}|06(?:\s?\d){8})/', '', $m[1]);
				$result['naam'] = trim($naam);
				continue;
			}

			// 10) Vluchtnummer
			if (preg_match('/\bVluchtnummer\s*:\s*(\w+)/i', $lineNorm, $m)) {
				$result['vluchtnummer'] = trim($m[1]);
				continue;
			}
			
			// 11) Opmerking label
			if (preg_match('/^Opmerking\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$result['opmerking'] = trim($m[1]);
				continue;
			}

			//  Prijs label
			if (preg_match('/^Prijs\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$price = trim($m[1]);
				$price = preg_replace('/\s*(€|euro)\s*/iu', '', $price);
    			$price = str_replace('.', ',', $price);
				$result['price'] = "€ " . str_replace('.', ',', $price);
				continue;
			}
			
			// ) Code label
			if (preg_match('/^Code\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$price1 = trim($m[1]);
				$price1 = preg_replace('/\s*(€|euro)\s*/iu', '', $price1);
    			$price1 = str_replace('.', ',', $price1);
				$price1 = preg_replace('/€/u', '', $price1);
				$result['price1'] = "Code € " . str_replace('.', ',', $price1);
				continue;
			}
			
			 // Return rit (ja/nee of een tekst)
			if (preg_match('/^Return\s*:\s*(.+)$/i', $lineNorm, $m)) {
				 $val = trim($m[1]);
				if (strcasecmp($val, 'Ja') === 0) {
					$val = 'Yes';
				}
				$result['return'] = $val;
				continue;
			}

			// Flight date (dd-mm-yyyy)
		/*	if (preg_match('/^Flight date\s*:\s*(\d{2}[-\/.]\d{2}[-\/.]\d{4})/i', $lineNorm, $m)) {
				$dateRaw = str_replace(['/', '.'], '-', $m[1]);
				$dt = \DateTime::createFromFormat('d-m-Y', $dateRaw);
				if ($dt !== false) {
					$result['flight_date'] = $dt->format('Y-m-d');
				}
				continue;
			}  */
			
	/*		if (preg_match('/^Return date.*:\s*(.+)$/i', $lineNorm, $m)) {
				$ts = strtotime(trim($m[1]));
				if ($ts !== false) {
					$result['flight_date'] = date('Y-m-d', $ts);
				}
				continue;
			} */
			
			// --- Flight date (heen / return) flexibel
			if (preg_match('/^Return\s*date(?:\s*(heen|return|terug))?\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$kind = isset($m[1]) ? strtolower($m[1]) : 'heen';
				$d = $this->parseDateToYmd($m[2]);
				if ($d) {
					if (preg_match('/return|terug/i', $kind)) {
						$result['return_flight_date'] = $d;
					} else {
						$result['flight_date'] = $d;
					}
				}
				continue;
			}


			// Flight time (hh:mm)
	/*		if (preg_match('/^Flight time\s*:\s*([0-2]?\d[:.]\d{2})/i', $lineNorm, $m)) {
				$result['flight_time'] = str_replace('.', ':', $m[1]);
				continue;
			} */
			/*if (preg_match('/^Return time.*:\s*([0-2]?\d[:.]\d{2})/i', $lineNorm, $m)) {
				$result['flight_time'] = str_replace('.', ':', $m[1]);
				continue;
			}*/
			
			// --- Flight time (heen / return) flexibel (negeert "uur")
			if (preg_match('/^Return\s*time(?:\s*(heen|return|terug))?\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$kind = isset($m[1]) ? strtolower($m[1]) : 'heen';
				$t = $this->parseTimeHm($m[2]);
				if ($t) {
					if (preg_match('/return|terug/i', $kind)) $result['return_flight_time'] = $t;
					else $result['flight_time'] = $t;
				}
				continue;
			}
			


			// Flight number on return
	/*		if (preg_match('/^Return\s*no\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$result['flight_no_on_return'] = trim($m[1]);
				continue;
			}*/
			
		/*	if (preg_match('/^Return.*flight.*no.*:\s*(.+)$/i', $lineNorm, $m)) {
				$result['flight_no_on_return'] = trim($m[1]);
				continue;
			} */
			
			// --- Vluchtnummer (heen / terug) flexibel
			if (preg_match('/\bVluchtnummer(?:\s*(heen|return|terug))?\s*:\s*([A-Za-z0-9\-]+)/i', $lineNorm, $m)) {
				if (!empty($m[1]) && preg_match('/return|terug/i', $m[1])) $result['flight_no_on_return'] = trim($m[2]);
				else $result['vluchtnummer'] = trim($m[2]);
				continue;
			}
			else if (preg_match('/^Return.*flight.*no.*:\s*(.+)$/i', $lineNorm, $m)) {
				$result['flight_no_on_return'] = trim($m[1]);
				continue;
			} 

			// Company
			if (preg_match('/^Company\s*:\s*(.+)$/i', $lineNorm, $m)) {
				$result['company'] = trim($m[1]);
				continue;
			}
		}

		// --- Fallbacks als nog leeg (search in fullText) ---
		if (!$result['datum']) {
			// probeer vrije tekst datum zoals "20 september 2025"
			if (preg_match('/\b([0-3]?\d)\s+(januari|februari|maart|april|mei|juni|juli|augustus|september|oktober|november|december)\s+(\d{4})/i', $fullText, $m)) {
				$dateStr = $m[1] . ' ' . $m[2] . ' ' . $m[3];
				$ts = strtotime($dateStr);
				if ($ts !== false) $result['datum'] = date('Y-m-d', $ts);
			}
		}

		if (!$result['tijd']) {
			// probeer "om 16.00" of losse tijd in fullText
			if (preg_match('/\bom\s*([0-2]?\d[:.]\d{2})\b/i', $fullText, $m)) {
				$result['tijd'] = str_replace('.', ':', $m[1]);
			} elseif (preg_match('/\b([0-2]?\d[:.]\d{2})\b/', $fullText, $m)) {
				$result['tijd'] = str_replace('.', ':', $m[1]);
			}
		}

		if (!$result['personen'] && preg_match('/(\d+)\s*pers/i', $fullText, $m)) {
			$result['personen'] = "Pax ".(int)$m[1];
		}
		if (!$result['vehicle'] && preg_match('/Bus\s*max\s*(\d+)/i', $fullText, $m)) {
			$result['vehicle'] = "Bus ".(int)$m[1];
		}
		if (!$result['price'] && preg_match('/€\s*([\d,\.]+)/i', $fullText, $m)) {
			$price = trim($m[1]);
			$price = preg_replace('/\s*(€|euro)\s*/iu', '', $price);
    		$price = str_replace('.', ',', $price);
			$result['price'] = "€ " . str_replace('.', ',', $price);
		}
		if (!$result['price1'] && preg_match('/code\s*€?\s*([\d,\.]+)/i', $fullText, $m)) {
			$price1 = trim($m[1]);
			$price1 = preg_replace('/\s*(€|euro)\s*/iu', '', $price1);
    		$price1 = str_replace('.', ',', 1);
			$price1 = preg_replace('/€/u', '', $price1);
			$result['price1'] = "€ " . str_replace('.', ',', $m[1]);$result['price1'] = "Code € ". $price1;
		}

		// --- House numbers uit van/naar halen met splitAddress ---
		[$result['van'], $fromNo] = $this->splitAddress($result['van'] ?? '');
		[$result['naar'], $toNo]   = $this->splitAddress($result['naar'] ?? '');
		$result['house_no_from'] = (stripos($result['van'] ?? '', 'schiphol') !== false) ? null : $fromNo;
		$result['house_no_to']   = (stripos($result['naar'] ?? '', 'schiphol') !== false)
			? ($result['vluchtnummer'] ? 'Flight '.$result['vluchtnummer'] : null)
			: $toNo;

		// --- Naam fallback (laatste regel of e-mail) ---
		if (!$result['naam']) {
			// probeer laatste niet-lege regel als naam
			$last = end($lines);
			if ($last) {
				// als last regel geen sleutelwoord bevat (Rit/Van/Naar/Prijs/Opmerking) dan aannemen als naam
				if (!preg_match('/\b(
					Rit\s*:|
					Van\s*:|
					Naar\s*:|
					Aantal\s*personen\s*:|
					Naam\s*:|
					Mobile\s*:|
					Vluchtnummer\s*:|
					Opmerking\s*:|
					Betaalwijze\s*:|
					Vehicle\s*:|
					Prijs\s*:|
					Vaste\s*ritprijs\s*:|
					Code\s*€|
					Code\s*:|
					Luggage\s*:|
					Email\s*:|
					Return\s*:|
					Flight\s*date\s*:|
					Flight\s*time\s*:|
					Return\s*no\s*:|
					Company\s*:
					)\b/ix', $last)) {
					$result['naam'] = trim(
						preg_replace('/(\+31\s?6(?:\s?\d){8}|06(?:\s?\d){8})/', '', $last)
					);
    }
			}
			// anders: gebruik e-mail als fallback naam
			if (!$result['naam'] && $result['email']) {
				$result['naam'] = $result['email'];
			}						
		}
		
		// --- Belangrijk: fallback datum = vandaag ---
		if (!$result['datum']) {
			$result['datum'] = date('Y-m-d');
		}
		
		return $result;
	}

	/**
	 * Split adres into "straat + plaats" and house number.
	 * Returns [$addressWithoutNumber, $houseNo|null]
	 */
	private function splitAddress(string $address): array
	{
		$address = trim($address);
		if ($address === '') return [null, null];

		// normalize separators
		$s = str_replace(['`', ',', '\\', '/'], ' ', $address);
		$s = preg_replace('/\s+/', ' ', $s);
		$s = trim($s);

		// bekende toevoegingen die niet bij straat of huisnummer horen
		$ignore = '(?:hoog|achter|voor|bg|hg|zwart)';

		/**
		 * Regex uitleg:
		 * ^(.*?)       → begin, straatdeel (non-greedy, stopt voor huisnummer)
		 * \s+(\d+)     → verplicht huisnummer
		 * ([A-Za-z]?)  → optionele letter (A, B, C)
		 * (?:-(\d+))?  → optioneel tweede nummer bij een range (12-14)
		 * (?:\s+$ignore)? → optionele toevoeging zoals 'hoog'
		 * \s*(.*)$     → rest (plaats, wijk, etc.)
		 */
		if (preg_match('/^(.*?)\s+(\d+)([A-Za-z]?)(?:-(\d+))?(?:\s+' . $ignore . ')?\s*(.*)$/iu', $s, $m)) {
			$street = trim($m[1] . ' ' . $m[5]);
			$street = preg_replace('/\s+/', ' ', $street);

			$house = $m[2]; // hoofdnummer
			if (!empty($m[3])) {
				$house .= strtoupper($m[3]); // letter direct plakken
			}
			if (!empty($m[4])) {
				$house .= '-' . $m[4]; // range toevoegen
			}

			return [$street !== '' ? $street : null, $house];
		}

		// fallback: last number = house
		if (preg_match('/^(.*\D)(\d+[A-Za-z\-]?)$/u', $s, $m)) {
			return [trim($m[1]), trim($m[2])];
		}

		return [$s, null];
	}



	private function getEmailBody($inbox, $email_number) {
		$structure = imap_fetchstructure($inbox, $email_number);
		$body = '';

		// Functie om inhoud correct te decoderen
		$decode = function($content, $encoding) {
			switch ($encoding) {
				case 3: return imap_base64($content);
				case 4: return imap_qprint($content);
				default: return $content;
			}
		};

		if (!isset($structure->parts)) {
			// Eenvoudige mail
			$body = imap_body($inbox, $email_number);
			$body = $decode($body, $structure->encoding);
		} else {
			// Multipart mail
			foreach ($structure->parts as $partNumber => $part) {
				if ($part->type == 0) { // text
					$subtype = strtoupper($part->subtype);

					// Eerst plain text pakken
					if ($subtype === 'PLAIN') {
						$body = imap_fetchbody($inbox, $email_number, $partNumber + 1);
						$body = $decode($body, $part->encoding);
						break;
					}

					// Als er geen plain is, pak HTML als fallback
					if ($subtype === 'HTML') {
						$body = imap_fetchbody($inbox, $email_number, $partNumber + 1);
						$body = strip_tags($decode($body, $part->encoding)); // HTML -> plain text
					}
				}
			}
		}

		return trim($body);
	}

	
	
	private function getEmailBodyFout($inbox, $email_number) {
		$structure = imap_fetchstructure($inbox, $email_number);

		$body = '';
		if (!$structure->parts) {
			// Eenvoudige mail
			$body = imap_body($inbox, $email_number);
		} else {
			// Mail met meerdere delen
			foreach ($structure->parts as $partNumber => $part) {
				if ($part->type == 0) { // text
					$body = imap_fetchbody($inbox, $email_number, $partNumber + 1);
					if ($part->encoding == 3) $body = imap_base64($body);
					if ($part->encoding == 4) $body = imap_qprint($body);
					break;
				}
			}
		}

		// Optioneel: HTML tags verwijderen
		$body = strip_tags($body);

		return trim($body);
	}
	
	private function cleanAddress($address) {
		$address = trim($address);
		$address = str_replace(['`', ','], ['', ''], $address); // verwijder backticks & komma’s
		$address = preg_replace('/\s+/', ' ', $address);        // dubbele spaties -> enkel
		return trim($address);
	}

	private function dutchMonthToNumber(string $month): ?int {
		$map = [
			'januari'=>1,'februari'=>2,'maart'=>3,'april'=>4,'mei'=>5,'juni'=>6,
			'juli'=>7,'augustus'=>8,'september'=>9,'oktober'=>10,'november'=>11,'december'=>12,
			'jan'=>1,'feb'=>2,'mrt'=>3,'apr'=>4,'mei'=>5,'jun'=>6,'jul'=>7,'aug'=>8,'sep'=>9,'sept'=>9,'okt'=>10,'nov'=>11,'dec'=>12
		];
		$m = mb_strtolower(trim($month), 'UTF-8');
		return $map[$m] ?? null;
	}

	private function parseDateToYmd(string $s): ?string {
		$s = trim(preg_replace('/\s+/', ' ', $s));
		// 1) dd-mm-yyyy or dd/mm/yyyy or dd.mm.yyyy
		if (preg_match('/\b([0-3]?\d)[\-\/\.]([0-1]?\d)[\-\/\.](\d{4})\b/u', $s, $m)) {
			$d = (int)$m[1]; $mo = (int)$m[2]; $y = (int)$m[3];
			if (checkdate($mo, $d, $y)) return sprintf('%04d-%02d-%02d', $y, $mo, $d);
		}
		// 2) dd <Dutch month> yyyy  (bijv. "3 oktober 2025")
		if (preg_match('/\b([0-3]?\d)\s+(januari|februari|maart|april|mei|juni|juli|augustus|september|oktober|november|december)\s+(\d{4})\b/iu', $s, $m)) {
			$d = (int)$m[1]; $mo = $this->dutchMonthToNumber($m[2]); $y = (int)$m[3];
			if ($mo && checkdate($mo, $d, $y)) return sprintf('%04d-%02d-%02d', $y, $mo, $d);
		}
		// 3) Probeer strtotime na omzetting van NL -> EN maandnamen
		$mapEng = [
			'januari'=>'January','februari'=>'February','maart'=>'March','april'=>'April','mei'=>'May',
			'juni'=>'June','juli'=>'July','augustus'=>'August','september'=>'September','oktober'=>'October',
			'november'=>'November','december'=>'December'
		];
		$sEng = str_ireplace(array_keys($mapEng), array_values($mapEng), $s);
		$ts = strtotime($sEng);
		if ($ts !== false) return date('Y-m-d', $ts);
		return null;
	}

	private function parseTimeHm(string $s): ?string {
		// accepteer 03:15 of 03.15 en negeer "uur"
		if (preg_match('/\b([0-2]?\d)[:\.]\s*([0-5]\d)\b/u', $s, $m)) {
			$h = (int)$m[1]; $mi = (int)$m[2];
			if ($h < 24) return sprintf('%02d:%02d', $h, $mi);
		}
		return null;
	}
/*	private function splitAddress($address) {
		$address = $this->cleanAddress($address);
		$houseNo = null;

		if (preg_match('/\b(\d+)\b/', $address, $m)) {
			$houseNo = $m[1];
			$address = preg_replace('/\b' . $houseNo . '\b/', '', $address, 1);
		}

		return [trim($address), $houseNo];
	} 
	// --- splitAddress helper ---
	private function splitAddress($text)
	{
		if (!$text) return [null, null];
		$text = trim(str_replace(["`", ","], ["", ""], $text));
		if (preg_match('/(.+?)\s+(\d+[a-zA-Z]?)/', $text, $m)) return [trim($m[1]), $m[2]];
		return [$text, null];
	} */
	
/*	private function splitAddress($text)
	{
		if (!$text) return [null, null];

		// Verwijder backticks en trim
		$text = str_replace('`', '', $text);
		$text = trim($text);

		// Scheidingstekens: , \ of meerdere spaties → vervangen door |
		$parts = preg_split('/[,\s\\\\]+/', $text, -1, PREG_SPLIT_NO_EMPTY);

		if (count($parts) >= 2) {
			// Laatste deel is meestal plaats
			$place = array_pop($parts);

			// Zoek huisnummer in de overgebleven delen (laatste getal)
			$lastPart = array_pop($parts);
			if (preg_match('/(\d+[a-zA-Z]?)/', $lastPart, $m)) {
				$houseNo = $m[1];
				$street = implode(' ', $parts);
				if ($street) $street .= ' ';
				$street .= preg_replace('/\d+/', '', $lastPart); // verwijder nummer uit straat
			} else {
				$houseNo = null;
				$street = implode(' ', $parts);
				if ($street) $street .= ' ';
				$street .= $lastPart;
			}

			$address = trim($street.' '.$place);
			return [$address, $houseNo];
		}

		return [$text, null];
	}*/ 
}

	