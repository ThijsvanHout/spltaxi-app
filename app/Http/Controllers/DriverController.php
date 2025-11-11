<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DriverController extends Controller
{
    public function index()
    {
        //$drivers = Driver::all();
		
		$drivers = Driver::orderBy('order', 'asc')->get();

        return view('layouts.drivers', ['drivers' => $drivers]);
    }

    public function create()
    {
        return view('layouts.adddrivers');
    }

    public function edit(Driver $driver)
    {
        return view('layouts.editdrivers', ['driver' => $driver]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $driver = new Driver();
        $driver->name = $request['name'];
        $driver->email = $request['email'];
        $driver->phone = $request['phone'];
        $driver->address = $request['address'];
        $driver->car_number = $request['car_number'];
        $driver->save();
        return redirect()->route('admin.drivers');
    }
    public function update(Request $request)
    {

        //dd($request);
        $data = Driver::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'car_number' => $request->car_number,
        ]);

        Session::flash('success', 'Data Updated successfully!');

        return redirect()->route('admin.drivers');
    }
	
	public function updateOrder(Request $request)
	{
		$order = explode(',', $request->input('order'));
    
		// Loop over de array en werk de volgorde van de chauffeurs bij
		foreach ($order as $index => $driverId) {
			$driver = Driver::find($driverId);
			if ($driver) {
				$driver->update(['order' => $index + 1]);
			}
		}
		
		$drivers = Driver::orderBy('order', 'asc')->get();

        return view('layouts.drivers', ['drivers' => $drivers]);
	}
}
