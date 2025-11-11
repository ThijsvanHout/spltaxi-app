<?php

namespace App\Http\Controllers;
use App\Models\PageDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PageDataController extends Controller
{
    public function aalsmeer()
    {

        $page_data = PageDetail::where('page_name', 'aalsmeer')->latest()->first();
        return view('/frontend/aalsmeer', compact('page_data'));
    }
     
    public function abcoude()
    {

        $page_data = PageDetail::where('page_name', 'abcoude')->latest()->first();
        return view('/frontend/abcoude', compact('page_data'));
    }

    public function amsterdam()
    {

        $page_data = PageDetail::where('page_name', 'amsterdam')->latest()->first();
        return view('/frontend/amsterdam', compact('page_data'));
    }

    public function diemen()
    {

        $page_data = PageDetail::where('page_name', 'diemen')->latest()->first();
        return view('/frontend/diemen', compact('page_data'));
    }
        

    public function duivendrecht()
    {

        $page_data = PageDetail::where('page_name', 'duivendrecht')->latest()->first();
        return view('/frontend/duivendrecht', compact('page_data'));
    } 
    
    public function haarlem()
    {

        $page_data = PageDetail::where('page_name', 'haarlem')->latest()->first();
        return view('/frontend/haarlem', compact('page_data'));
    } 

    public function ouderkerk()
    {

        $page_data = PageDetail::where('page_name', 'ouderkerk')->latest()->first();
        return view('/frontend/ouderkerk', compact('page_data'));
    } 
    
    public function uithoorn()
    {

        $page_data = PageDetail::where('page_name', 'uithoorn')->latest()->first();
        return view('/frontend/uithoorn', compact('page_data'));
    }

    public function reserve(Request $request)
    {
        $dataReceived = $request['pickup_address'];
        return view('frontend.reserve', compact('dataReceived'));
    }

    public function getreserve(Request $request)
    {
        $dataReceived = $request['pickupaddress'];
        return view('frontend.reserve', compact('dataReceived'));
    }
    
}
