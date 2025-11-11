<?php

namespace App\Http\Controllers;
use App\Models\PageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PageDetailController extends Controller
{
    public function details(Request $request)
    {
        //dd($request);
        $pageDetail = PageDetail::where('page_name', $request['page_name'])->first();
        if ($pageDetail) {

            Session::flash('danger', 'Data Already Exist!');
            return redirect()->back();

        }else{

        

        

        $data = new PageDetail();
        $data->start_to_destination = $request['std'];
        $data->vehicle_price = $request['vp'];
        $data->person_luggage = $request['pl'];
        $data->pickup_place = $request['pp'];
        $data->min_person = $request['min_person'];
        $data->max_person = $request['max_person'];
        $data->page_name = $request['page_name'];
        $data->save();

        Session::flash('success', 'Data saved successfully!');
        return redirect()->back();


        }
        
    }

    public function show(){

        $data = PageDetail::all();
        return view('/layouts/adddetails', compact('data'));
        //print_r($data);

    }

    public function update(Request $request)
    {
        //dd($request['id']);
        // $request->validate([
        //     'start_to_destination' => 'required',
        //     'vehicle_price' => 'required',
        //     'person_luggage' => 'required',
        //     'pickup_place' => 'required',
        //     'min_person' => 'required',
        //     'max_person' => 'required',
        //     'page_name' => 'required',
        // ]);

        $pageDetail = PageDetail::find($request['id']);
        //dd($pageDetail);
        if (!$pageDetail) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        //$UpdateDetails = PageDetail::where('page_name', $request['page_name'])->first();

       $data = PageDetail::where('page_name', $request->page_name)->update([
            'start_to_destination' => $request->start_to_destination,
            'vehicle_price' => $request->vehicle_price,
            'person_luggage' => $request->person_luggage,
            'pickup_place' => $request->pickup_place,
            'min_person' => $request->min_person,
            'max_person' => $request->max_person,
        ]);

        //dd($data);

        return redirect()->back()->with('success', 'Record updated successfully.');
    }

    public function destroy(Request $request)
    {
        // Find the record by ID
        $id = $request['id'];
        $pageDetail = PageDetail::find($id);

        // Check if the record exists
        if (!$pageDetail) {
            return redirect()->back()->with('error', 'Record not found.');
        }

        // Delete the records based on page_name
        PageDetail::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Records deleted successfully.');
    }

}
